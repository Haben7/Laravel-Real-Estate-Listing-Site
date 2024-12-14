<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }
h1{
  color: blue;
}
        body {
            background-image: url('images/ghaziabad-uttar-pradesh-homes-photos-1366x768.webp');
            background-size: cover; 
            background-position: center; 
            font-family: Arial, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.9); 
            width: 500px; 
            height: 400px;
            text-align: center; 
        }

        input[type="email"], input[type="password"] {
            width: 100%; 
            padding: 10px;
            margin: 10px 0; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            margin-top: 40px
        }

        button {
            background-color: blue; 
            color: white; 
            padding: 10px; 
            border: none; 
            border-radius: 4px;
            cursor: pointer; 
            width: 100%;
            font-size: 16px; 
            margin-top: 30px;
            margin-bottom: 30px
        }

        button:hover {
            background-color: blue;
        }

        .error-messages {
            color: red; 
            margin-bottom: 10px; 
        }
        a{
          text-decoration: none;
          color: blue;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div>
                {{-- <label for="email">Email</label> --}}
                <input type="email" name="email" placeholder="inser your email"required>
            </div>
            <div>
                {{-- <label for="password">Password</label> --}}
                <input type="password" name="password" placeholder="inser your password" required>
            </div>
            <button type="submit">Login</button>
            {{-- <a href="">Forgot Your Password?</a> --}}
        </form>
    </div>
</body>
</html>
