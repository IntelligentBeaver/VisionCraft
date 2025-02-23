<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Resume;

class ResumeOptimizer extends Component
{
    use WithFileUploads;

    public $resume;
    public $fileName = '';
    public $downloadUrl; // URL to download the processed resume

    public function uploadResume()
    {
        $this->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048', // Validate file type and size
        ]);

        // Get original file details
        $filePath = $this->resume->getRealPath();
        $originalName = $this->resume->getClientOriginalName();

        try {
            // Send resume to Flask API
            $response = Http::attach(
                'resume',
                file_get_contents($filePath),
                $originalName
            )->post('http://127.0.0.1:5000/upload_resume');

            if ($response->failed()) {
                session()->flash('error', 'Flask API error. Please try again.');
                return;
            }

            // Get the processed filename from Flask API
            $responseData = $response->json();
            $processedFilename = $responseData['filename'] ?? null;

            if (!$processedFilename) {
                session()->flash('error', 'Failed to retrieve processed resume filename.');
                return;
            }

            // Construct the download URL from Flask
            $downloadUrl = "http://127.0.0.1:5000/download/$processedFilename";

            // Fetch the processed resume from Flask API
            $processedResume = Http::get($downloadUrl);

            if ($processedResume->failed()) {
                session()->flash('error', 'Error downloading processed resume.');
                return;
            }

            // Save the file in Laravel storage using the exact filename returned by Flask
            $storagePath = "resumes/$processedFilename";
            Storage::disk('public')->put($storagePath, $processedResume->body());

            // Save resume details in database
            Resume::create([
                'user_id' => Auth::id(),
                'filename' => $storagePath, // Store the actual processed filename
            ]);

            // Set download URL for frontend
            $this->downloadUrl = asset("storage/$storagePath");

            session()->flash('message', 'Resume processed and saved successfully!');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong. Please try again.');
        }
    }
    public function deleteResume($id)
    {
        $resume = Resume::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($resume->filename);

        // Delete from database
        $resume->delete();

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
}