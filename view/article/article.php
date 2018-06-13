<?php

use App\Service\ValidationService as Check;
use App\Service\ErrorRepository;

$content = ob_start();

$check = new Check();
if ($check->varIsValid($articleToShow) === true) {
    foreach ($articleToShow as $article) {
        echo '<h1 style="font-weight: bold; color: #343A40";>' . strip_tags($article->getTitle()) . '</h1>';
        echo '<h6 style="color: orange;"> Publié par ' . strip_tags($article->getAuthor()) . '</h6>';
        echo '<p style="font-size: 10pt; font-weight: bold; color: grey;"> Le : ' . strip_tags($article->getCreatedAt()) . '</p>';
        echo '<p style="text-align: justify";>' . nl2br(strip_tags($article->getContent())) . '<p>';
    }
} else {
    $errorRepository = new ErrorRepository();
    $errorRepository->articleNone();
}


?>

<form method="POST" action="">
    <div class="form-group">
        <label>Pseudo</label>
        <input type="text" class="form-control" name="pseudo">
    </div>
        <label>Commentaires</label>
    <div class="form-group">
        <textarea class="form-control" name="comment"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Envoyer" class="btn btn-primary">
    </div>
</form>

<a href="index.php/?page=article.index&p=1">Retour à la liste des articles</a>
<?php

$content = ob_get_clean();
require '../view/templates/default.php';
