<?php
include_once'../../Config.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = User::findRegisteredUser($_POST['login'], $_POST['password']);

    if ($user) {
        session_start([
            'cookie_lifetime' => 86400,
        ]);
        $_SESSION['userId'] = $user->getId();

        header('Location: ../todolist/todolist.php');
    } else {
        print_r('user not found!');
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awesome Todo List Maker</title>
    <h1>Login with an existing account!</h1>
</head>
<body>
<form method="post" action="">
    Login:<br>
    <input type="text" name="login"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Submit">
</form>
<a href='../../index.php'>Home</a><br>
</body>
</html>
