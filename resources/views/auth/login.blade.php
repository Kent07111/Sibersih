<!DOCTYPE html>
<html>

<head>

<title>Login</title>

</head>

<body>

<h2>LOGIN ADMIN</h2>

@if(session('error'))

{{ session('error') }}

@endif

<form action="/login" method="POST">

@csrf

<input
type="text"
name="username"
placeholder="Username">

<br><br>

<input
type="password"
name="password"
placeholder="Password">

<br><br>

<button>

Login

</button>

</form>

</body>

</html>
