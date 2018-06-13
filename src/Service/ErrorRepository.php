<?php

namespace App\Service;

class ErrorRepository
{

    /**
     * 
     */
    public function notFound()
    {
        header("HTTP/1.0 404 Not found");
        header('Location:index.php?page=404');
    }
    
    /**
     * 
     */
    public function articleNone()
    {
        require '../view/error/articleNone.php';
    }

    public function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die ('Acces Interdit'); // En attente d'une page customisée
    }
}