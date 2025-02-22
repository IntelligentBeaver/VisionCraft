<!-- resources/views/job_recommendation.blade.php -->
<!DOCTYPE html>
<html>

    <head>
        <title>Job Recommender</title>
    </head>

    <body>
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

        @if (isset($recommendations) && count($recommendations) > 0)
            <h3>Recommended Jobs:</h3>
            <table border="1">
                <tr>
                    <th>Job Title</th>
                    <th>Industry</th>
                    <th>Functional Area</th>
                    <th>Role</th>
                    <th>Similarity Score</th>
                </tr>
                @foreach ($recommendations as $job)
                    <tr>
                        <td>{{ $job['Job Title'] }}</td>
                        <td>{{ $job['Industry'] }}</td>
                        <td>{{ $job['Functional Area'] }}</td>
                        <td>{{ $job['Role'] }}</td>
                        <td>{{ number_format($job['Similarity Score'], 2) }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No recommendations available. Please enter your details and try again.</p>
        @endif
    </body>

</html>
