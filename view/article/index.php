<?php

use App\Service\ValidationService as Check;
use App\Model\ErrorRepository;
use App\Repository\Pagingrepository as Paging;

$content = ob_start();

?>
<h1 style="color: #007BFF;"> Liste de tous les articles publiés sur le Blog</h1>
<hr>
<form method="POST" action="/?page=article.index&p=<?= $current; ?>">
        <label>Nombre d'articles par pages :</label>
        <select name="perPage" id="perPage" style="margin-left: 25px;">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <button type="submit" style="margin-left: 50px;">Appliquer</button>
    </form>
<hr>

<?php
$check = new Check();
if ($check->varIsValid($articleList) === true) {
    foreach ($articleList as $article) {
        ?>
        <a href="<?= $article->getURL(); ?>"style="font-size: 22pt; font-weight: bold; color: #343A40;"><?= strip_tags($article->getTitle()); ?></a>
        <h6 style="color: orange;"> Publié par <?= strip_tags($article->getAuthor()); ?></h6> 
        <p style="font-size: 10pt; font-weight: bold; color: grey;"> Le : <?= strip_tags($article->getCreatedAt()); ?></p>
        <p style="text-align: justify";><?= nl2br(strip_tags($article->getExcerpt())); ?><p>
        <?php
    } ?>
<?php
} else {
        $errorRepository = new ErrorRepository();
        $errorRepository->articleNone();
    }

?>

<ul class="pagination">
<?php 
    if ($current > 1) {
        ?>
       <li class="page-item"><a class="page-link" href="/?page=article.index&p=<?php if ($current != '1') {
            echo $current-1;
        } else {
            echo $current;
        } ?>"><</a></li>
        <?php
    }
?>    
<?php
    for ($i=1; $i<=$pageNb; $i++) {
        ?>
        <li class="page-item"><a class="page-link" href="/?page=article.index&p=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
    }
?>
<?php 
    if ($current < $pageNb) {
        ?>
        <li class="page-item"><a class="page-link" href="/?page=article.index&p=<?= $current+1; ?>">></a></li>     
        <?php
    }
?>
</ul>

<?php
$content = ob_get_clean();
require '../view/templates/default.php';
