<?php

use App\Livewire\ResumeOptimizer;
use App\Models\Res;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    config(['services.flask.url' => 'http://flask.test']);
});

it('requires login for resume and recommendation routes', function (string $method, string $uri) {
    $this->{$method}($uri)->assertRedirect('/login');
})->with([
    ['get', '/upload-resume-form'],
    ['post', '/upload-resume'],
    ['get', '/download-resume/ATS_Resume_1.docx'],
    ['get', '/recommend-jobs-form'],
    ['post', '/recommend-jobs'],
]);

it('only lets the owner download a generated resume', function () {
    Http::fake(['flask.test/download/*' => Http::response('docx-bytes')]);
    $owner = User::factory()->create();
    $other = User::factory()->create();
    Res::create(['user_id' => $owner->id, 'filename' => 'ATS_Resume_1.docx']);

    $this->actingAs($other)->get('/download-resume/ATS_Resume_1.docx')->assertNotFound();

    $response = $this->actingAs($owner)->get('/download-resume/ATS_Resume_1.docx');
    $response->assertOk();
    expect($response->streamedContent())->toBe('docx-bytes');
});

it('rejects non-pdf uploads', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/upload-resume', ['resume' => UploadedFile::fake()->create('cv.exe', 10)])
        ->assertSessionHasErrors('resume');
});

it('returns an error instead of crashing when flask is down', function () {
    Http::fake(['flask.test/*' => Http::response('', 500)]);
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from('/recommend-jobs-form')
        ->post('/recommend-jobs', ['skills' => 'php', 'industry' => 'IT', 'functional_area' => 'Dev'])
        ->assertRedirect('/recommend-jobs-form')
        ->assertSessionHas('error');
});

it('stores optimized resumes privately for the uploader', function () {
    Storage::fake('local');
    Http::fake([
        'flask.test/upload_resume' => Http::response(['filename' => 'ATS_Resume_2.docx']),
        'flask.test/download/*' => Http::response('docx-bytes'),
    ]);
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ResumeOptimizer::class)
        ->set('resume', UploadedFile::fake()->createWithContent('cv.pdf', "%PDF-1.4\n%test\n"))
        ->call('uploadResume')
        ->assertHasNoErrors();

    Storage::disk('local')->assertExists('resumes/ATS_Resume_2.docx');
    expect(Resume::where('user_id', $user->id)->count())->toBe(1);
});

it('does not let users delete or download another user\'s resume', function () {
    Storage::fake('local');
    $owner = User::factory()->create();
    $other = User::factory()->create();
    Storage::disk('local')->put('resumes/a.docx', 'x');
    $resume = Resume::create(['user_id' => $owner->id, 'filename' => 'resumes/a.docx']);

    expect(fn () => Livewire::actingAs($other)->test(ResumeOptimizer::class)->call('deleteResume', $resume->id))
        ->toThrow(ModelNotFoundException::class);

    expect(fn () => Livewire::actingAs($other)->test(ResumeOptimizer::class)->call('download', $resume->id))
        ->toThrow(ModelNotFoundException::class);

    expect(Resume::find($resume->id))->not->toBeNull();
    Storage::disk('local')->assertExists('resumes/a.docx');
});
