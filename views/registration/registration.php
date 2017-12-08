<?php
include_once '../../Config.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new User(
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['login'],
        $_POST['password']
    );

    $userRegistrationController = new UserRegistrationController();
    $userRegistrationController->registerUser($model);
    header('registrationSuccessful.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awesome Todo List Maker</title>
    <h1>Create an account</h1>
</head>
<body>
<form method="post" action="">
    Login:<br>
    <input type="text" name="login"><br>
    Password:<br>
    <input type="password" name="password"><br><br>
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname"><br><br>
    <input type="submit" value="Submit">
</form>
<a href='../../index.php'>Home</a><br>
</body>
</html>
