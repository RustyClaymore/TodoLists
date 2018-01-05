<?php
session_start();
?>

<html lang="en">
<head>
    <title>Awesome Todo List</title>
    <link rel="stylesheet" type="text/css" href="../Resources/css/todoListStyle.css">
</head>

<div class="header">
    <header>
        <h1>Awesome Todo List</h1>
    </header>
</div>

<div class="main_page">
    <body>
    <h3>Existing user</h3>
    <?php if (isset($_SESSION['userId'])) { ?>
        <a href='views/todolist/todolist.php'>Continue Session</a><br>
    <?php } else { ?>
        <a href="views/login/login.php">Login with an existing account!</a><br>
    <?php } ?>

    <?php if (isset($_SESSION['userId'])) { ?> <a href='views/logout/logout.php'>Logout</a><br> <?php } ?>

    <h3>New user</h3>
    <a href="views/registration/registration.php">Registration link!</a><br>
    </body>

</div>
<html>
