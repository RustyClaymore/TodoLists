<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

const project_path = '/Users/yakin.najahi/Documents/Projects/Todo List/TodoLists/';

include_once project_path . 'Db.php';

include_once project_path . 'models/User.php';
include_once project_path . 'models/Task.php';

include_once project_path . 'controllers/UserRegistrationController.php';
include_once project_path . 'controllers/TaskSavingController.php';

function getDOMDocument($strhtml): DOMDocument {
    $dochtml = new DOMDocument();
    $dochtml->loadHTML($strhtml);

    return $dochtml;
}
