<?php

namespace App\Entity;

class Comment
{

    private $id;
    private $articleId;
    private $pseudo;
    private $createdAt;
    private $content;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data) 
    {
        if (is_array($data)) {
            if(isset($data['id'])) {
                $this->setId($data['id']);
            }
            /*if(isset($data['articleId'])) {
                $this->setArticleId($data['articleId']);
            }*/
            if(isset($data['pseudo'])) {
                $this->setPseudo($data['pseudo']);
            }
            if(isset($data['createdAt'])) {
                $this->setCreatedAt($data['createdAt']);
            }
            if(isset($data['content'])) {
                $this->setContent($data['content']);
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId()
    {
        $this->id = $id;
    }

    /*public function getarticleId()
    {
        return $this->articleId;
    }

    public function setArticleId()
    {
        $this->articleId = $articleId;
    }*/

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo()
    {
        $this->pseudo = $pseudo;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt()
    {
        $this->createdAt = $createdAt;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent()
    {
        $this->content = $content;
    }



}