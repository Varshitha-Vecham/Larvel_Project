
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Task Manager</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            width: 90%;
            max-width: 500px;
            padding: 50px 35px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h1 {
            color: #222;
            font-size: 32px;
            margin-bottom: 15px;
        }

        p {
            color: #666;
            font-size: 16px;
            margin-bottom: 35px;
        }

        a {
            display: inline-block;
            padding: 13px 30px;
            margin: 5px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .login {
            background: #2563eb;
        }

        .register {
            background: #16a34a;
        }

        .login:hover {
            background: #1d4ed8;
        }

        .register:hover {
            background: #15803d;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Task Manager</h1>

        <p>Manage your daily tasks easily.</p>

        <a href="{{ route('login') }}" class="login">
            Login
        </a>

        <a href="{{ route('register') }}" class="register">
            Register
        </a>

    </div>

</body>
</html>
