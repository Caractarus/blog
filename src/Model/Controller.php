<?php

namespace App\Model;

abstract class Controller
{

    private $userService;

    protected function __construct()
    {
        $this->userService = $userService;
    }

    // Faire ref a l'utilisateur de SESSION et tester le role admin avec la dfocntion is granted
    //  si il est admin et si il a pas accès redirection (page connexion)
    protected function isAdmin()
    {

    }

}