<!DOCTYPE html>
<html>

    <head>
        <title>Resume Optimizer & Job Recommender</title>
    </head>

    <body>
        <h2>Upload Resume</h2>
        <form action="{{ url('/upload-resume') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="resume" type="file" required>
            <button type="submit">Upload</button>
        </form>

        <h2>Job Recommendations</h2>
        <form action="{{ url('/recommend-jobs') }}" method="POST">
            @csrf
            <label>Skills:</label>
            <input name="skills" type="text" required>
            <label>Industry:</label>
            <input name="industry" type="text" required>
            <label>Functional Area:</label>
            <input name="functional_area" type="text" required>
            <button type="submit">Get Recommendations</button>
        </form>
    </body>

</html>
