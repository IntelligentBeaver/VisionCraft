<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Single entry point for the Flask ML service (job recommender + ATS resume optimizer).
 * Configure with FLASK_API_URL / FLASK_API_TIMEOUT.
 */
class FlaskClient
{
    /**
     * @return array<int, array<string, mixed>>
     *
     * @throws ConnectionException|RequestException
     */
    public function recommend(string $skills, string $industry, string $functionalArea): array
    {
        return $this->request()
            ->post('/recommend', [
                'skills' => $skills,
                'industry' => $industry,
                'functional_area' => $functionalArea,
            ])
            ->throw()
            ->json('recommendations', []);
    }

    /**
     * Sends a PDF resume and returns the generated ATS .docx filename.
     *
     * @throws ConnectionException|RequestException
     */
    public function optimizeResume(string $contents, string $originalName): string
    {
        $filename = $this->request()
            ->attach('resume', $contents, $originalName)
            ->post('/upload_resume')
            ->throw()
            ->json('filename');

        if (! is_string($filename) || $filename !== basename($filename)) {
            throw new \UnexpectedValueException('Flask returned an invalid resume filename.');
        }

        return $filename;
    }

    /**
     * @throws ConnectionException|RequestException
     */
    public function downloadResume(string $filename): Response
    {
        return $this->request()
            ->get('/download/'.rawurlencode(basename($filename)))
            ->throw();
    }

    private function request(): PendingRequest
    {
        return Http::baseUrl(rtrim(config('services.flask.url'), '/'))
            ->timeout((int) config('services.flask.timeout'))
            ->acceptJson();
    }
}
