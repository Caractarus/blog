<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Form\ArticleType;
use App\Repository\DBAuthRepository as DBAuth;
use App\Model\ErrorRepository;

/**
 * Link between the index file and the views through different models
 */
class ArticleController
{
    /**
     * This method give all the informations requested by the article.index view to display existing articles
     */
    public function index($pageNb, $current, $start, $perPage)
    {
        $articleRepository = new ArticleRepository();
        $articleList = $articleRepository->getByLimit($start, $perPage);
        require '../view/article/index.php';
    }

    /**
     * This method allows getting an entire article after clicking on the link
     */
    public function show()
    {
        $articleRepository = new ArticleRepository();
        $articleToShow = $articleRepository->getArticle($_GET['id']);
        require '../view/article/article.php';
    }

    /**
     * This method
     */
    public function administrate($pageNb, $current, $start, $perPage)
    {
        $auth = new DBAUth();
        $errorRepository = new ErrorRepository();

        
        /*if (!$auth->logged()) {
            $errorRepository->forbidden();
        }*/

        $articleRepository = new ArticleRepository();
        $articleList = $articleRepository->getByLimit($start, $perPage);
        
        // On récupère l'article si lien avec l'id cliqué
        if (isset($_GET['updateId'])) {
            $articleUpdate = $articleRepository->getUpdatedArticle();
        } elseif (isset($_GET['deleteId'])) {
            $articleRepository->delete();
        }

        // On effectue les verifications pour update ou déclencher les erreurs
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On verifie si l'article est ok pour publication
            $articleType = new ArticleType();
            if (isset($_POST['update'])) {
                if ($articleType->isValid()) {
                    $articleRepository->update($current);
                } else {
                    $error = $articleType->notValid();
                }
            } else {
                if ($articleType->isValid()) {
                    $articleRepository->add();
                } else {
                    $error = $articleType->notValid();
                }
            }
        }
        require '../view/admin/index.php';
    }
}
