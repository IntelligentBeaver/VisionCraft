<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Send Data to Flask</title>
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

            input,
            button {
                display: block;
                width: 100%;
                padding: 10px;
                margin: 10px 0;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Enter Job Details</h1>
            <form action="/send-to-flask" method="POST">
                @csrf
                <label for="skills">Skills:</label>
                <input name="skills" type="text" required>

                <label for="industry">Industry:</label>
                <input name="industry" type="text" required>

                <label for="functional_area">Functional Area:</label>
                <input name="functional_area" type="text" required>

                <button type="submit">Submit</button>
            </form>
        </div>
    </body>

</html>
