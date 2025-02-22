<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flask API Response</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 20px;
                background-color: #f4f4f4;
            }

            .container {
                max-width: 600px;
                background: white;
                padding: 20px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #333;
            }

            p {
                font-size: 18px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Flask API Response</h1>
            <p><strong>Message:</strong> {{ $data['message'] }}</p>

            @if (isset($data['response']['recommendations']))
                <h2>Job Recommendations</h2>
                <ul>
                    @foreach ($data['response']['recommendations'] as $job)
                        <li>Job Title<strong>{{ $job['Job Title'] }}</strong> <br>
                            Industry:{{ $job['Industry'] }} <br>
                            Functional Area:({{ $job['Functional Area'] }})
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </body>

</html>
