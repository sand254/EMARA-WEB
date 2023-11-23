<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Application</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Room Application</h1>
        <p>Dear Admin,</p>
        <p>A new room application has been submitted. Here are the details:</p>

        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ email }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ phone }}</td>
            </tr>
            <tr>
                <td>Check-in Date</td>
                <td>{{ check_in_date }}</td>
            </tr>
            <tr>
                <td>Check-out Date</td>
                <td>{{ check_out_date }}</td>
            </tr>
            <tr>
                <td>Number of Kids</td>
                <td>{{ number_of_kids }}</td>
            </tr>
            <tr>
                <td>Number of Adults</td>
                <td>{{ number_of_adults }}</td>
            </tr>
        </table>

        <p>Thank you for your attention.</p>
        <p>Best regards,<br>Your Room Application System</p>
    </div>
</body>

</html>