<?php
declare(strict_types=1);

class TaskSavingController
{
    public function saveTask(Task $model): bool
    {
        return $model->saveToDB();
    }
}
