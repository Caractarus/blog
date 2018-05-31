<?php

namespace Core\Repository;

use Core\Model\Repository;

class DBAuth extends Repository
{
    private $db;

    public function __construct(Repository $db)
    {
        $this->db = $db;
    }

    /**
     * @param $username
     * @param $password
     * @return bool True if the user can acess and false if he can't
     */
    public function login($username, $password)
    {
        $user = $this->getPDO()->prepare('SELECT * FROM users WHERE username = ?');
        $user->execute(array($_POST['username']));
        var_dump($user);
    }

    public function logged()
    {
        return isset($_SESSION['auth']);
    }

        
}