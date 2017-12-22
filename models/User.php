<?php
declare(strict_types=1);

class User
{
    private $id;

    private $firstName;

    private $lastName;

    private $login;

    private $password;

    public function __construct($firstName, $lastName, $login, $password)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->login     = $login;
        $this->password  = $password;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public static function all()
    {
        $list = [];
        $db   = Db::getInstance();

        try {
            $req = $db->query('SELECT * FROM users');

            foreach ($req->fetchAll() as $user) {
                $usr = new User(
                    $user['firstname'],
                    $user['lastname'],
                    $user['login'],
                    $user['password']
                );
                $usr->setID($user['id']);

                $list[] = $usr;
            }
        } catch (Exception $e) {
            Throw new ErrorException('no table users found in the database.\n', $e->getMessage());
        }

        return $list;
    }

    public static function findByID($id)
    {
        $db = Db::getInstance();

        $id = (int)$id;

        $req = $db->prepare('SELECT * FROM users WHERE id =  :id');
        $req->execute(['id' => $id]);
        $user = $req->fetch();

        $usr = new User(
            $user['firstname'],
            $user['lastname'],
            $user['login'],
            $user['password']
        );
        $usr->setID($user['id']);

        return $usr;
    }

    public static function findRegisteredUser($login, $password)
    {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM users WHERE login =  :login AND password = :password');
        $req->execute(['login' => $login, 'password' => $password]);
        $user = $req->fetch();

        if ($user) {
            $usr = new User(
                $user['firstname'],
                $user['lastname'],
                $user['login'],
                $user['password']
            );
            $usr->setID($user['id']);

            return $usr;
        }

        return null;
    }

    public function register(): bool
    {
        $db = Db::getInstance();
        if (isset($db)) {
            $req = $db->prepare('INSERT INTO users (lastname, firstname, login, password) VALUES (:lastname, :firstname, :userLogin, :userPassword)');

            $req->bindValue(':lastname', $this->lastName);
            $req->bindValue(':firstname', $this->firstName);
            $req->bindValue(':userLogin', $this->login);
            $req->bindValue(':userPassword', $this->password);

            $req->execute();

            return true;
        }

        return false;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
