<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="login-form">
        <h2>Login</h2>
        <form action="/adminLogin" method="POST">
            @csrf
            <div class="field">
                <label>Admin</label>
                <input name="email" type="text" required>
            </div>
            <div class="field">
                <label>Password</label>
                <input name="password" type="password" required>
            </div>
            <input class="submit" type="submit" value="Login">
        </form>
    </div>
</body>

</html>