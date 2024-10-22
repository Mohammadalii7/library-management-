<!DOCTYPE html>
<html>
<head>
    <title>Late Book Return Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Late Book Return Notification</h1>

        <p>Dear {{ $user->name ?? 'User' }},</p>

        <p>You have returned the book titled "<strong>{{ $book->title ?? 'N/A' }}</strong>" late by <strong>{{ $daysLate ?? 'N/A' }}</strong> days.</p>
        <p>The fine amount for the late return is <strong>${{ $fineAmount ?? '0' }}</strong>.</p>

        <p>Please make sure to return books on time in the future to avoid fines.</p>

        <p>Thank you!</p>
    </div>
</body>
</html>
