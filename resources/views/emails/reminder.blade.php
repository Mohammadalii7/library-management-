    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Return Reminder</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                line-height: 1.6;
            }

            .container {
                background-color: #ffffff;
                width: 80%;
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border: 1px solid #e0e0e0;
            }

            h1 {
                color: #333;
                text-align: center;
                font-size: 24px;
                margin-bottom: 20px;
            }

            p {
                color: #555;
                font-size: 16px;
                margin: 10px 0;
            }

            .book-title {
                color: #007bff;
                font-weight: bold;
            }

            .cta-button {
                display: block;
                width: 100%;
                text-align: center;
                margin: 20px 0;
            }

            a.button {
                background-color: #28a745;
                color: #fff;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 4px;
                font-size: 16px;
                display: inline-block;
                font-weight: bold;
            }

            a.button:hover {
                background-color: #218838;
            }

            .book-photo {
                display: none;
                margin-top: 20px;
                text-align: center;
            }

            .book-photo img {
                max-width: 100%;
                height: auto;
                border-radius: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 14px;
                color: #999;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h1>Reminder: Book Return Due Soon</h1>
            <p>Hello {{ $user->name }},</p>
            <p>This is a reminder that the book <span class="book-title">{{ $book->title }}</span> is due for return in 5 days.</p>
            <p>Please make sure to return it on time to avoid any fines.</p>



            <!-- Image and title section initially hidden -->
            {{-- <h3>{{ $book->title }}</h3>
            <img src="{{ url('books/' . $book->image) }}" alt="Cover image of {{ $book->title }}" style="border-radius: 20px; min-width: 195px;"> --}}
            {{-- Log::info('Image path: ' . url('books/' . $book->image)); --}}

            <p>Thank you!</p>

            <div class="footer">
                <p>Haven Book Library</p>
                <p>If you have any questions, feel free to contact us at support@havenbooklibrary.com.</p>
            </div>
        </div>


    </body>
    </html>
