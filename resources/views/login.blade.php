<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4; /* Optional: Background color for better contrast */
        }

        /* Login Container */
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        button {
            height: 48px;
            width: 130px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
            font-weight: bold;
        }

        /* Input Group */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #     ;
            padding-left: 40px; /* Space for the icon */
        }

        .form-group input:focus {
            outline: none;
            border: 1px solid #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        /* Button */
        .pushable {
            position: relative;
            background: transparent;
            padding: 0px;
            border: none;
            cursor: pointer;
            outline: none;
            transition: filter 250ms;
        }

        .shadow {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: hsl(226, 25%, 69%);
            border-radius: 12px;
            filter: blur(3px);
            will-change: transform;
            transform: translateY(3px);
            transition: transform 600ms cubic-bezier(0.3, 0.7, 0.4, 1);
        }

        .edge {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            background: linear-gradient(to right,
                    hsl(248, 39%, 39%) 0%,
                    hsl(248, 39%, 49%) 8%,
                    hsl(248, 39%, 39%) 92%,
                    hsl(248, 39%, 29%) 100%);
        }

        .front {
            display: block;
            position: relative;
            border-radius: 12px;
            background: hsl(248, 53%, 58%);
            padding: 14px 35px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1rem;
            transform: translateY(-4px);
            transition: transform 600ms cubic-bezier(0.3, 0.7, 0.4, 1);
        }

        .pushable:hover {
            filter: brightness(110%);
        }

        .pushable:hover .front {
            transform: translateY(-6px);
            transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
        }

        .pushable:active .front {
            transform: translateY(-2px);
            transition: transform 34ms;
        }

        .pushable:hover .shadow {
            transform: translateY(5px);
            transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
        }

        .pushable:active .shadow {
            transform: translateY(2px);
            transition: transform 34ms;
        }

        .pushable:focus:not(:focus-visible) {
            outline: none;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <i class="fas fa-envelope" style="font-size:20px; margin-top:10px;"></i>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <i class="fas fa-lock" style="font-size:20px; margin-top:10px;"></i>
                <input type="password" id="password" name="password" required>
            </div>
            <button class="pushable">
                <span class="shadow"></span>
                <span class="edge"></span>
                <span class="front">
                    Submit
                </span>
            </button>

            @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'red',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            </script>
            @endif
        </form>
        <br>
        <p>If you are not registered click here <a href="/">Register</a></p>
    </div>
</body>
</html>
