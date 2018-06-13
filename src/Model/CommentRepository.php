<?php

namespace App\Model;

use App\Model\DataBase;
use App\Entity\Comment;

class CommentRepository extends DataBase
{

    public function getComment()
    {
        $req = $this->getPDO()->prepare('SELECT * FROM comments WHERE articleId = ?');
        $req->execute(array($_GET['id']));
        while ($data = $req->fetch()) {
            $comment [] = new Comment($data);
        }
        return $comment;
    }

    public function add()
    {
        $req = $this->getPDO()->prepare('INSERT INTO comments(pseudo, comment, articleId, createdAt,) VALUES(:pseudo, :comment, :articleId, NOW())');
        $req->bindValue(":pseudo", $_POST['pseudo'], PDO::PARAM_STR);
        $req->bindValue(":content", $_POST['content'], PDO::PARAM_STR);
        $req->bindValue(":articleId", $_GET['id'], PDO::PARAM_INT);
        $req->execute();

        header('Location:index.php/?page=admin&p='.$current.'');
    }

    public function update()
    {
        $req = $this->getPDO()->prepare('UPDATE comments SET pseudo = :pseudo, comment = :comment, updatedAt = NOW() WHERE id = :id');
    }

    public function delete()
    {

    }

    public function modarate()
    {

    }

}