<?php
declare(strict_types=1);

class Task
{
    private $id;

    private $name;

    private $description;

    private $userId;

    public function __construct($name, $description)
    {
        $this->name        = $name;
        $this->description = $description;
    }

    /**
     * @param int $userId
     *
     * @return Task[]
     * @throws ErrorException
     */
    public static function all($userId)
    {
        $list = [];
        $db   = Db::getInstance();

        try {
            $req = $db->prepare('SELECT * FROM tasks WHERE user_id = :userId');
            $req->execute([':userId' => $userId]);

            foreach ($req->fetchAll() as $task) {
                $tsk = new Task(
                    $task['name'],
                    $task['description']
                );
                $tsk->setID($task['id']);
                $tsk->setUserId($task['user_id']);

                $list[] = $tsk;
            }
        } catch (Exception $e) {
            Throw new ErrorException('no table tasks found in the database.\n', $e->getMessage());
        }

        return $list;
    }

    public static function findTaskByName($name)
    {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM task WHERE name = :name');
        $req->execute(['name' => $name]);
        $task = $req->fetch();

        if ($task) {
            $tsk = new Task(
                $task['name'],
                $task['description']
            );
            $tsk->setID($task['id']);
            $tsk->setUserId($task['user_id']);

            return $tsk;
        }

        return null;
    }

    public static function delete($name): bool
    {
        $db = Db::getInstance();
        if (isset($db)) {
            $req = $db->prepare('DELETE FROM tasks WHERE name = :name');

            $req->bindValue(':name', $name);

            $req->execute();

            return true;
        }

        return false;
    }

    public function saveToDB(): bool
    {
        $db = Db::getInstance();
        if (isset($db)) {
            $req = $db->prepare('INSERT INTO tasks (name, description, user_id) VALUES (:name, :description, :userId)');

            $req->bindValue(':name', $this->name);
            $req->bindValue(':description', $this->description);
            $req->bindValue(':userId', $this->userId);

            $req->execute();

            return true;
        }

        return false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }
}
