<?php

use App\Service\ValidationService as Check;
use App\Model\ErrorRepository;

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
<a href="index.php/?page=article.index&p=1">Retour à la liste des articles</a>
<?php

$content = ob_get_clean();
require '../view/templates/default.php';
