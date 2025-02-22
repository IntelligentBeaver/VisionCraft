<!-- resources/views/resume_upload.blade.php -->
<!DOCTYPE html>
<html>

    <head>
        <title>Resume Optimizer</title>
    </head>

    <body>
        <h2>Upload Resume</h2>
        <form action="{{ url('/upload-resume') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="resume" type="file" required>
            <button type="submit">Upload</button>
        </form>
    </body>

</html>
