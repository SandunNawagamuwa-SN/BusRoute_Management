<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="api/password/reset" method="POST">
            <h2>Fogot Password</h2>

            <input name="email" placeholder="Enter email" value="{{request()->get('email')}}">
            <input name="password" placeholder="Enter new password">
            <input name="password_confirmation" placeholder="Confirm new password">
            <input hidden name="token" placeholder="token" value="{{request()->get('token')}}">

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>