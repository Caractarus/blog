<?php

session_start();
if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['content'])) {
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['author'] = $_POST['author'];
    $_SESSION['content'] = $_POST['content'];
}
$content = ob_start();
?>

<h1 style="color: #007BFF;"> Publier un nouvel article sur le Blog </h1>
<hr>

<?php
    if (isset($articleUpdate) || isset($error)) {
        if (isset($articleUpdate)) {
            foreach ($articleUpdate as $update) {
                $update;
            }
        }
    }
?>
    
<form method="POST" action="/?page=admin&p=<?= $current; ?>">
    <label style="font-weight: bold;">Titre</label> : <?php if (isset($error) && in_array($articleType::TITLE_INVALID, $error, true)) {
    echo '<em style="color: orange; font-size: 10pt;">' . $articleType::TITLE_INVALID . '</em>';
} ?>
    <br/><input type="text" name="title" value="<?php if (isset($update)) {
    echo strip_tags($update->getTitle());
} ?>"><br/><br/>
    <label style="font-weight: bold;">Auteur</label> : <?php if (isset($error) && in_array($articleType::AUTHOR_INVALID, $error, true)) {
    echo '<em style="color: orange; font-size: 10pt;">' . $articleType::AUTHOR_INVALID . '</em>';
} ?>
    <br/><input type="text" name="author" value="<?php if (isset($update)) {
    echo strip_tags($update->getAuthor());
} ?>"><br/><br/>
    <label style="font-weight: bold;">Article</label> : <?php if (isset($error) && in_array($articleType::CONTENT_INVALID, $error, true)) {
    echo '<em style="color: orange; font-size: 10pt;">' . $articleType::CONTENT_INVALID . '</em>';
} ?>
    <br/><textarea rows="10" cols="155" name="content"><?php if (isset($update)) {
    echo strip_tags($update->getContent());
} ?></textarea><br/>
    <input type="hidden" name="id" value="<?php if (isset($update)) {
    echo strip_tags($update->getId());
} ?>">

<?php 
    if (isset($_GET['updateId'])) {
        ?>
        <input type="submit" value="Modifier" class="btn btn-primary"><br/>
        <input type="hidden" name="update" class="btn btn-primary">
<?php
    } else {
        ?>
        <input type="submit" value="Publier" class="btn btn-primary">
<?php
    }
?>
</form>

<br/><br/>
<h1 style="color: #007BFF;"> Administration des articles publiés </h1> 
<hr><p style="color: orange; font-size: 12pt;"> Sélectionnez dans la liste ci dessous un article à modifier ou à supprimer </p>

<form method="POST" action="/?page=admin&p=<?= $current; ?>">
    <label>Nombre d'articles par pages :</label>
    <select name="perPage" id="perPage" style="margin-left: 25px;">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
    </select>
    <button type="submit" style="margin-left: 50px;">Appliquer</button>
</form>

<hr>
<table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date</th>
      
      <th colspan="2" scope="col"><a href="/?page=admin&p=1" >Publier un article sur le Blog</a></th>
    </tr>
    </thead>
<?php
    foreach ($articleList as $article) {
        ?>

    <tbody>
    <tr style="height: 40px;">
        <td style="width: 500px; font-weight: bold;"><?= $article->getTitle(); ?></td>
        <td style="width: 200px;"><?= $article->getAuthor(); ?></td>
        <td style="width: 250px;"><?= $article->getcreatedAt(); ?></td>
        <td style="width: 150px;"><a href="/?page=admin&p=<?= $current; ?>&updateId=<?= $article->getId(); ?>">Modifier</a></td>
        <td style="width: 150px;"><a href="/?page=admin&p=<?= $current; ?>&deleteId=<?= $article->getId(); ?>">Supprimer</a></td>
    </tr>
    </tbody>


<?php
    }
?>
</table>
<hr>
<ul class="pagination">  
<?php 
    if ($current > 1) {
        ?>
        <li class="page-item"><a class="page-link" href="/?page=admin&p=<?php if ($current != '1') {
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
        <li class="page-item"><a class="page-link" href="/?page=admin&p=<?= $i; ?>"><?= $i; ?></a></li>
        <?php
    }
        ?>
<?php 
    if ($current < $pageNb) {
        ?>
        <li class="page-item"><a class="page-link" href="/?page=admin&p=<?= $current+1; ?>">></a></li>     
        <?php
    }
        ?>
</ul>


<?php
$content = ob_get_clean();
require '../view/templates/default.php';
