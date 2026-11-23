<?php

namespace App\Livewire;

use App\Models\Resume;
use App\Services\FlaskClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class ResumeOptimizer extends Component
{
    use WithFileUploads;

    public $resume;
    public $fileName = '';
    public $processedResumeId; // ID of the resume generated in this session

    public function uploadResume(FlaskClient $flask)
    {
        $this->validate([
            // The Flask optimizer only parses PDFs.
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $processedFilename = $flask->optimizeResume(
                file_get_contents($this->resume->getRealPath()),
                $this->resume->getClientOriginalName(),
            );

            $processedResume = $flask->downloadResume($processedFilename);

            // Private disk: resumes hold personal data and must not be publicly guessable.
            $storagePath = "resumes/$processedFilename";
            Storage::disk('local')->put($storagePath, $processedResume->body());

            $resume = Resume::create([
                'user_id' => Auth::id(),
                'filename' => $storagePath,
            ]);

            $this->processedResumeId = $resume->id;

            session()->flash('message', 'Resume processed and saved successfully!');
        } catch (Throwable $e) {
            Log::error('Resume optimization failed', ['exception' => $e]);
            session()->flash('error', 'Something went wrong. Please try again.');
        }
    }

    public function download($id)
    {
        $resume = $this->ownedResume($id);
        $disk = $this->diskFor($resume);

        abort_unless($disk, 404);

        return Storage::disk($disk)->download($resume->filename, basename($resume->filename));
    }

    public function deleteResume($id)
    {
        $resume = $this->ownedResume($id);

        if ($disk = $this->diskFor($resume)) {
            Storage::disk($disk)->delete($resume->filename);
        }

        $resume->delete();

        if ($this->processedResumeId == $id) {
            $this->processedResumeId = null;
        }

        session()->flash('message', 'Resume deleted successfully!');
    }

    public function clearFile()
    {
        $this->resume = null;
        $this->fileName = '';
    }

    public function render()
    {
        $resumes = Resume::where('user_id', Auth::id())->latest()->get();

        return view('livewire.resume-optimizer', compact('resumes'));
    }

    private function ownedResume($id): Resume
    {
        return Resume::where('user_id', Auth::id())->findOrFail($id);
    }

    /** Older resumes were saved on the public disk; new ones live on the private disk. */
    private function diskFor(Resume $resume): ?string
    {
        foreach (['local', 'public'] as $disk) {
            if (Storage::disk($disk)->exists($resume->filename)) {
                return $disk;
            }
        }

        return null;
    }
}
