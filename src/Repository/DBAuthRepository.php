<?php

// authentification par bdd

namespace App\Repository;

use App\Model\Repository;
use \PDO;

class DBAuthRepository extends Repository
{

    /**
     * @username
     * @password
     * @return bool True if users can access and false if not
     */
    public function login()
    {
        $req = $this->getPDO()->prepare('SELECT * FROM users WHERE username = :username');
        $req->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();
        if (!empty($user)) {
            return true;
        } else {
            return false;
        }
        $var_dump(sha1('demo'));

        /*$user = $this->getPDO()->prepare('SELECT * FROM users WHERE username = ?', [$username]);
        
        var_dump($user);*/
    }

    /**
     * @param string $_SESSION
     * @return bool true if user is already logged
     */
    public function logged()
    {
        if(isset($_SESSION['authentified'])) {
            return true;
        }
    }
}
