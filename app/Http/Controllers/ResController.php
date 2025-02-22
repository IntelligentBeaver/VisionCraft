<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Res;
use Illuminate\Container\Attributes\Auth;

class ResController extends Controller
{
    public function showForm()
    {
        // Show the form page where users enter data
        return view('res');
    }
    public function uploadResume(Request $request)
    {
        $file = $request->file('resume');

        // Send resume to Flask API
        $response = Http::attach(
            'resume',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post('http://127.0.0.1:5000/upload_resume');

        if ($response->failed()) {
            return response()->json(['error' => 'Flask API error'], 500);
        }

        $responseData = $response->json();
        $filename = $responseData['filename'];

        // Store resume filename in database
        $resume = new Res();
        $resume->user_id = \Illuminate\Support\Facades\Auth::id(); // Store logged-in user ID
        $resume->filename = $filename;
        $resume->save();

        return redirect("http://127.0.0.1:5000/download/$filename");


        // return response()->json([
        //     'message' => 'Resume uploaded and processed successfully!',
        //     'download_url' => url('/download-resume/' . $filename)
        // ]);
    }

    public function downloadResume($filename)
    {
        return redirect("http://127.0.0.1:5000/download/$filename");
    }

    public function recommendJobs(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5000/recommend', [
            'skills' => $request->input('skills'),
            'industry' => $request->input('industry'),
            'functional_area' => $request->input('functional_area'),
        ]);

        return response()->json($response->json());
    }
}