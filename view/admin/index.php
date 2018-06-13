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

<form class="col-lg-12" method="POST" action="/?page=admin&p=<?= $current; ?>">
    <div class="form-group">
        <label style="font-weight: bold;">Titre</label> : <?php if (isset($error) && in_array($articleType::TITLE_INVALID, $error, true)) {
        echo '<em style="color: orange; font-size: 10pt;">' . $articleType::TITLE_INVALID . '</em>';
        } ?>
        <input type="text" class="form-control" name="title" value="<?php if (isset($update)) {
        echo strip_tags($update->getTitle());
        } ?>">
    </div>
    <div class="form-group">
        <label style="font-weight: bold;">Auteur</label> : <?php if (isset($error) && in_array($articleType::AUTHOR_INVALID, $error, true)) {
        echo '<em style="color: orange; font-size: 10pt;">' . $articleType::AUTHOR_INVALID . '</em>';
        } ?>
        <input type="text" class="form-control" name="author" value="<?php if (isset($update)) {
        echo strip_tags($update->getAuthor());
        } ?>">
    </div>
    <div class="form-group">
        <label style="font-weight: bold;">Article</label> : <?php if (isset($error) && in_array($articleType::CONTENT_INVALID, $error, true)) {
        echo '<em style="color: orange; font-size: 10pt;">' . $articleType::CONTENT_INVALID . '</em>';
        } ?>
        <textarea class="form-control" name="content"><?php if (isset($update)) {
        echo strip_tags($update->getContent());
        } ?></textarea>
        <em class="help-block">Vous pouvez agrandir la fenêtre</em>
    
        <input type="hidden" name="id" value="<?php if (isset($update)) {
        echo strip_tags($update->getId());
        } ?>"><br/>
    </div>
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

<nav class="navbar">
    <div class="container">
        <form class="navbar-form navbar-right inline-form" method="POST" action="/?page=admin&p=<?= $current; ?>">
            <label>Nombre d'articles par pages :</label>
                <div class="btn-group">
                <select name="perPage" id="perPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <button type="submit" class="btn btn-primary btn-xs">Appliquer</button>
                </div>
        </form>
    </div>
</nav>

<hr>
<div class="container">
    <section class="col-md-12 col-xs-8 table-responsive">
        <table class="table table-bordered table-hover">
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
            <tr>
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
    </section>
</div>

<hr>

<div class="container col-lg-3">
    <ul class="pagination">  
    <?php 
        if ($current > 1) {
            ?>
            <li class="page-item"><a class="page-link" href="/?page=admin&p=<?php if ($current != '1') {
                echo $current-1;
            } else {
                echo $current;
            } ?>">&laquo;</a></li>
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
            <li class="page-item"><a class="page-link" href="/?page=admin&p=<?= $current+1; ?>">&raquo;</a></li>     
            <?php
        }
            ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
require '../view/templates/default.php';
