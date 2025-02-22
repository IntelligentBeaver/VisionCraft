<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function showUploadPage()
    {
        return view('resume_upload');
    }

    public function processResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048',
        ]);

        // Store the uploaded resume in the storage
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Simulating an optimized resume (Replace with actual optimization logic)
        $optimizedResumePath = 'storage/resumes/optimized_resume.pdf';

        return view('resume_process', compact('resumePath', 'optimizedResumePath'));
    }
}
