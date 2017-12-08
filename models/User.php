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

    public static function all()
    {
        $list = [];
        $db   = Db::getInstance();

        try {
            $req = $db->query('SELECT * FROM users');

            foreach ($req->fetchAll() as $user) {
                $list[] = new User(
                    $user['id'],
                    $user['firstname'],
                    $user['lastname'],
                    $user['login'],
                    $user['password']
                );
            }
        } catch (Exception $e) {
            Throw new ErrorException('no table users found in the database.\n', $e->getMessage());
        }

        return $list;
    }

    public static function find($id)
    {
        $db = Db::getInstance();

        $id = (int)$id;

        $req = $db->prepare('SELECT * FROM users WHERE id =  :id');
        $req->execute(['id' => $id]);
        $user = $req->fetch();

        return new User(
            $user['id'],
            $user['firstname'],
            $user['lastname'],
            $user['login'],
            $user['password']
        );
    }

    public static function findRegisteredUser($login, $password)
    {
        $db = Db::getInstance();

        $req = $db->prepare('SELECT * FROM users WHERE login =  :login AND password = :password');
        $req->execute(['login' => $login, 'password' => $password]);
        $user = $req->fetch();

        if ($user) {
            return new User(
                $user['id'],
                $user['firstname'],
                $user['lastname'],
                $user['login'],
                $user['password']
            );
        } else {
            return null;
        }
    }

    public function registerUser(): bool
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
}
