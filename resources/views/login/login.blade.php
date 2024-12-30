<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: rgb(255, 111, 0);
            /* background-image:  url('images/logo.png'); */
            /* Replace with the path to your background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        a {
            text-decoration: none;
            color: #ccc;
            font-size: 12px;
            margin-top: 10px;
            display: block;
        }

        a:hover {
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <h1>LOGIN</h1>
            <form method="POST" action="{{ route('loginAkun') }}">
                @csrf
                <label for="username" style="text-align: left;">Email</label>
                <input type="text" id="email" name="email" placeholder="example@gmail.com">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password" style="text-align: left;">Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button type="submit">Login</button>
                {{-- <a href="#">Forgot Password?</a> --}}
            </form>
        </div>
    </div>
</body>

</html>
