<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    
    public function index()
    {
        return view('resume');
    }

    
    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048', 
        ]);

        
        $filename = time() . '_' . $request->file('resume')->getClientOriginalName();
        $request->file('resume')->storeAs('resumes', $filename, 'public');

        return view('resume', compact('filename')); 
    }

    
    public function optimize($filename)
    {
        
        $optimizedFilename = 'optimized_' . $filename;
        Storage::disk('public')->copy('resumes/' . $filename, 'resumes/' . $optimizedFilename);

        return view('resume', compact('filename', 'optimizedFilename'));
    }

    
    public function download($filename)
    {
        $filePath = storage_path("app/public/resumes/{$filename}");

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }
}
