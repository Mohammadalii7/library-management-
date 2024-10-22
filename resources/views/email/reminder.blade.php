<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Return Reminder</title>
</head>
<body>
    <h1>Reminder: Book Return Due Soon</h1>
    <p>Hello {{ $user->name }},</p>
    <p>This is a reminder that the book <strong>{{ $book->title }}</strong> is due for return in 5 days.</p>
    <p>Please make sure to return it on time to avoid any fines.</p>
    <p>Thank you!</p>
</body>
</html>
