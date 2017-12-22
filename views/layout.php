<?php
session_start();
?>

<html lang="en">
<head>
    <title>Awesome Todo List</title>
    <link rel="stylesheet" type="text/css" href="../Resources/css/todoListStyle.css">
</head>

<div class="header">
    <header>Awesome Todo List
        <br><a href='../index.php'>Home</a><br>
    </header>
</div>

<div class="main_page">
    <br>
    <body>
    <h3>New user</h3>
    <a href="views/registration/registration.php">Registration link!</a><br>

    <h3>Already a user</h3>
    <?php if (isset($_SESSION['userId'])) { ?>
        <a href='views/todolist/todolist.php'>Continue Session</a><br>
    <?php } else { ?>
        <a href="views/login/login.php">Login with an existing account!</a><br>
    <?php } ?>

    <?php if (isset($_SESSION['userId'])) { ?> <a href='views/logout/logout.php'>Logout</a><br> <?php } ?>
    </body>

</div>
<html>
