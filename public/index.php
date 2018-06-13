<?php

require_once "../vendor/autoload.php"; // Déclaration de l'autoloader de composer

use App\Controller\ArticleController;
use App\Service\ErrorRepository;
use App\Entity\Paging;

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if (!empty($page)) {
        if (isset($_GET['p']) && !empty($_GET['p'])) {
            if (isset($_POST['perPage'])) {
                $perPage = (int) $_POST['perPage'];
            } else {
                $perPage = 5;
            }
            $paging = new Paging($perPage);
            $pageNb = $paging->pageNb();
            $current = $paging->current();
            $start = $paging->start();
  
            $p = $_GET['p'];
            if ($page === 'article.index' && $p === $_GET['p']) {
                $articleController = new ArticleController();
                $articleController->index($pageNb, $current, $start, $perPage);
            } elseif ($page === 'admin' &&  $p === $_GET['p']) {
                $articleController = new ArticleController();
                $articleController->administrate($pageNb, $current, $start, $perPage);
            }
        } elseif ($page === 'article') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $articleController = new ArticleController();
                $articleController->show();
            } else {
                $errorRepository = new ErrorRepository();
                $errorRepository->notFound();
            }
        } elseif ($page === 'login') {
            require '../view/users/login.php';
        } elseif ($page === '404') {
            require '../view/error/error404.php';
        } else {
            $errorRepository = new ErrorRepository();
            $errorRepository->notFound();
        }
    } else {
        $errorRepository = new ErrorRepository();
        $errorRepository->notFound();
    }
} else {
    $errorRepository = new ErrorRepository();
    $errorRepository->notFound();
}
