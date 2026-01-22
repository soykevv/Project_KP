<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .error-message {
            background: #ffe6e6;
            color: #cc0000;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: all 0.2s;
        }

        form input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        button:hover {
            background: #0056b3;
        }

        .footer {
            margin-top: 15px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Login</button>
    </form>

    <div class="footer">
        &copy; {{ date('Y') }} CV Montana
    </div>
</div>

</body>
</html>
