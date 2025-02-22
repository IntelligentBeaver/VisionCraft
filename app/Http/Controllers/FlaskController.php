<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlaskController extends Controller
{
    public function showForm()
    {
        // Show the form page where users enter data
        return view('flask-form');
    }
    public function showFlaskData()
    {
        // Fetch data from Flask API
        $response = Http::get('http://127.0.0.1:5000/test');

        // Decode JSON response
        $jsonResponse = json_decode($response->body(), true);

        // Pass data to the Blade view
        return view(view: 'flask-data')->with('data', $jsonResponse);
    }
    public function sendToFlask(Request $request)
    {
        // Validate input
        $request->validate([
            'skills' => 'required|string',
            'industry' => 'required|string',
            'functional_area' => 'required|string',
        ]);

        // Send data to Flask API
        $response = Http::post('http://127.0.0.1:5000/recommend', [
            'skills' => $request->input('skills'),
            'industry' => $request->input('industry'),
            'functional_area' => $request->input('functional_area')
        ]);

        // Decode the Flask response
        $jsonResponse = json_decode($response->body(), true);

        // Display success message in the Blade file
        return view('flask-data')->with('data', ['message' => 'Data sent successfully!', 'response' => $jsonResponse]);
    }
}