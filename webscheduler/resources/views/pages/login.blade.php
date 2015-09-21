<!doctype html>

<html lang="en">

<head>
		<meta charset="UTF-8">
		<title> Document</title>
</head>

<body>
	<h1>"Welcome to the login page!"</h1>
	<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>
	
</body>
</html>