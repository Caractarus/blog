<?php

namespace App\Repository;

use App\Entity\Article;
use App\Model\Repository;
use \PDO;

/**
 * Class ArticleRepository CRUD
 */
class ArticleRepository extends Repository
{
    /**
     * @param array Give the entire articles list sorted out DESC
     * @return $articleAll
     */
    public function getAll()
    {
        $req = $this->getPDO()->query('SELECT *, DATE_FORMAT(createdAt, "%d/%m/%Y à %Hh%imin") AS createdAt FROM articles ORDER BY createdAt DESC');
        $req->execute();
        while ($data = $req->fetch()) {
            $articleAll [] = new Article($data); // A chaque tour de boucle il instancie un nouvel article
        }
        return $articleAll;
    }

    /**
     * @param array $articleList Give a list of the db' articles with a limit applyied on. 
     * @return $articleList
     */
    public function getByLimit($start, $perPage)
    {
        $req = $this->getPDO()->query('SELECT *, DATE_FORMAT(createdAt, "%d/%m/%Y à %Hh%imin") AS createdAt FROM articles ORDER BY createdAt DESC LIMIT '.$start.', '.$perPage.'');
        $req->execute();
        while ($data = $req->fetch()) {
            $articleList [] = new Article($data); // A chaque tour de boucle il instancie un nouvel article
        }
        return $articleList;
    }

    /**
     * @param array Allows to get the entire article 
     * @return $articleToShow
     */
    public function getArticle()
    {
        $req = $this->getPDO()->prepare('SELECT *, DATE_FORMAT(createdAt, "%d/%m/%Y à %Hh%imin") AS createdAt FROM articles WHERE id = ?');
        $req->execute(array($_GET['id']));
        $data = $req->fetch();
        $articleToShow [] = new Article($data);
        
        return $articleToShow;
    }

    /**
     * @param array $articleUpdate Allows to update a targetted article
     * @return $articleUpdate
     */
    public function getUpdatedArticle()
    {
        $req = $this->getPDO()->prepare('SELECT *, DATE_FORMAT(createdAt, "%d/%m/%Y à %Hh%imin") AS createdAt FROM articles WHERE id = ?');
        $req->execute(array($_GET['updateId']));
        $data = $req->fetch();
        $articleUpdate [] = new Article($data);

        return $articleUpdate;
    }

    /**
     * @param array Allows to add an article into the database
     */
    public function add()
    {
        $req = $this->getPDO()->prepare('INSERT INTO articles(title, author, content, createdAt) VALUES(:title, :author, :content, NOW())');
        $req->bindValue(":title", $_POST['title'], PDO::PARAM_STR);
        $req->bindValue(":author", $_POST['author'], PDO::PARAM_STR);
        $req->bindValue(":content", $_POST['content'], PDO::PARAM_STR);
        $req->execute();

        header('Location:index.php/?page=admin&p=1');
    }

    /**
     * @param array update of articles data into the db
     */
    public function update($current)
    {
        $req = $this->getPDO()->prepare('UPDATE articles SET title = :title, author = :author, content = :content, updatedAt = NOW() WHERE id = :id');
        $req->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $req->bindValue(':author', $_POST['author'], PDO::PARAM_STR);
        $req->bindValue(':content', $_POST['content'], PDO::PARAM_STR);
        $req->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $req->execute();

        header('Location:index.php/?page=admin&p='. $current . '');
    }

    /**
     * This method allows to delete an article from the db
     */
    public function delete()
    {
        $req = $this->getPDO()->prepare('DELETE FROM articles WHERE id = :id');
        $req->bindValue(':id', $_GET['deleteId'], PDO::PARAM_INT);
        $req->execute();

        header('Location:index.php/?page=admin&p=1');
    }
}
