<?php

namespace App\Http\Controllers;

use App\Models\Res;
use App\Services\FlaskClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ResController extends Controller
{
    public function __construct(private FlaskClient $flask)
    {
    }

    public function showResumeForm()
    {
        return view('resume-upload');
    }

    public function showRecommendationForm()
    {
        return view('job-recommendation');
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('resume');

        try {
            $filename = $this->flask->optimizeResume($file->get(), $file->getClientOriginalName());
        } catch (Throwable $e) {
            Log::error('Resume optimization failed', ['exception' => $e]);

            return back()->with('error', 'Resume service is unavailable. Please try again.');
        }

        Res::create([
            'user_id' => $request->user()->id,
            'filename' => $filename,
        ]);

        return redirect()->route('resume.download', $filename);
    }

    public function downloadResume(Request $request, string $filename)
    {
        // Users may only download resumes they generated.
        $resume = Res::where('user_id', $request->user()->id)
            ->where('filename', $filename)
            ->firstOrFail();

        try {
            $file = $this->flask->downloadResume($resume->filename);
        } catch (Throwable $e) {
            Log::error('Resume download failed', ['exception' => $e]);
            abort(502, 'Resume service is unavailable.');
        }

        return response()->streamDownload(
            fn () => print($file->body()),
            basename($resume->filename),
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        );
    }

    public function recommendJobs(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'required|string|max:1000',
            'industry' => 'required|string|max:255',
            'functional_area' => 'required|string|max:255',
        ]);

        try {
            $recommendations = $this->flask->recommend(
                $validated['skills'],
                $validated['industry'],
                $validated['functional_area'],
            );
        } catch (Throwable $e) {
            Log::error('Job recommendation failed', ['exception' => $e]);

            return back()->withInput()->with('error', 'Recommendation service is unavailable. Please try again.');
        }

        return view('job-recommendation', compact('recommendations'));
    }
}
