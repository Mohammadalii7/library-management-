<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Borrowed Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .book-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .book-details h4 {
            margin: 0;
            color: #007BFF;
        }

        .book-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Hi {{ $user->name }},</h1>
        <p>Thank you for borrowing the book titled "<strong>{{ $book->title }}</strong>".</p>

     
        <div class="book-details">
            <h4>Book Details:</h4>
            <p><strong>Author:</strong> {{ $book->author->author_name }}</p>
            <p><strong>Description:</strong> {{ $book->description }}</p>
            <p><strong>Copies Available:</strong> <strong>{{ $book->copies_available }}</strong></p>
            <p><strong>Date Borrowed:</strong> {{ now()->format('F j, Y') }}</p>
            <img src="{{ $message->embed(public_path('books/' . $book->image)) }}" alt="Cover image of {{ $book->title }}" style="border-radius: 20px;" width="195">

        </div>

        <p>We hope you enjoy reading it!</p>
        <p>If you have any questions, feel free to contact us.</p>

        <div class="footer">
            <p>Best regards,<br><strong>Haven Book Library</strong></p>
        </div>
    </div>
</body>

</html>
