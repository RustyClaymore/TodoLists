<?php
include_once '../../Config.php';

session_start();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new Task($_POST['name'], $_POST['description']);

    if (isset($_SESSION['userId'])) {
        $model->setUserId($_SESSION['userId']);
    }

    $taskSavingController = new TaskSavingController();
    $taskSavingController->saveTask($model);
}

if (isset($_GET['delete_task'])) {
    $taskName = $_GET['delete_task'];
    Task::delete($taskName);
}

?>

<html lang="en">
<head>
    <title>
        Welcome to your to Todo List
    </title>
    <link rel="stylesheet" href="../../Resources/css/todoListStyle.css">
</head>


<div class="header">
    <header>
        <a href='../../index.php'>Home</a><br>
        <a href='../logout/logout.php'>Logout</a><br>
    </header>

</div>

<div class="heading">
    <h2>My todo list</h2>
</div>
<div>
    <form method="POST" action="">
        <input type="text" name="name" class="task_input">
        <input type="text" name="description" class="task_input">
        <button type="submit" class="add_btn" name="Submit">Add Task</button>
    </form>

    <table>
        <thread>
            <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
        </thread>

        <tbody>
        <?php
        $tasks = Task::all($_SESSION['userId']);
        foreach ($tasks as $task) { ?>
            <tr>
                <td class="task_name"><?php echo $task->getName(); ?></td>
                <td class="task_description"><?php echo $task->getDescription(); ?></td>
                <td class="delete">
                    <a href="todolist.php?delete_task=<?php echo $task->getName() ?>">x</a>
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</div>
<html>
