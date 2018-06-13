<?php

namespace App\Controller;

abstract class UserController
{

    private $userService;

    protected function __construct()
    {
        $this->userService = $userService;
    }

    // Faire ref a l'utilisateur de SESSION et tester le role admin avec la fonction is granted
    //  si il est admin et si il a pas accès redirection (page connexion)
    protected function isAdmin()
    {

    }

}