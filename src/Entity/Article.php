<?php

namespace App\Entity;

/**
 * Describe the article and his assets and functions
 */
class Article
{
    /**
     * @var string $title Describe the title data
     */
    private $title;

    /**
     * @var string $author Describe the author data
     */
    private $author;

    /**
     * @var string $content Describe the content data
     */
    private $content;

    /**
     * @var int $createdAt Describe the added date into the database
     */
    private $createdAt;

    /**
     * @var int $updatedAt Describe the updated date
     */
    private $updatedAt;

    /**
     * @param array $data Le constructeur envoi à l'objet les données passées en paramètre lors de l'hydratation
     */
    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * @param array Hydrate l'objet via le constructeur avec les données
     */
    private function hydrate($data) //  **************   QUESTION !!!!! COMMENT ON PEUT HYDRATER AVEC $DATA[] alors qu'on ne spécifie pas de use ou de require. Comment il fait pour trouver la valeur ?
    {
        if (is_array($data)) {
            if (isset($data['id'])) {
                $this->setId($data['id']);
            }
            if (isset($data['title'])) {
                $this->setTitle($data['title']);
            }
            if (isset($data['author'])) {
                $this->setAuthor($data['author']);
            }
            if (isset($data['content'])) {
                $this->setContent($data['content']);
            }
            if (isset($data['createdAt'])) {
                $this->setCreatedAt($data['createdAt']);
            }
        }
        /*
public function hydrate(array $donnees)
{
  foreach ($data as $key => $value)
  {
    // On récupère le nom du setter correspondant à l'attribut.
    $method = 'set'.ucfirst($key);

    // Si le setter correspondant existe.
    if (method_exists($this, $method))
    {
      // On appelle le setter.
      $this->$method($value);
    }
  }
}*/
    }

    /**
     * @param string retourne l'erreur
     */
    public function getError()
    {
        return $this->error;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string obtenir le titre
     * return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @param string déterminer le titre
     */
    public function setTitle($title)
    {
        /*if (!is_string($title) || empty($title)) {
            $this->error[] = self::TITLE_INVALID;
        } else {*/
            $this->title = $title;
        //}
    }
    
    /**
     * @param string obtenir le nom de l'auteur
     * return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string déterminer le nom de l'auteur
     */
    public function setAuthor($author)
    {
        /*if (!is_string($author) || empty($author)) {
            $this->error[] = self::AUTHOR_INVALID;
        } else {*/
            $this->author = $author;
        //}
    }

    /**
     * @param string retourne le contenu de l'article
     * return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string détermine de contenu de l'article
     */
    public function setContent($content)
    {
        /*if (!is_string($content) || empty($content)) {
            $this->error[] = self::CONTENT_INVALID;
        } else {*/
            $this->content = $content;
        //}
    }

    /**
     * @param int retourne la date d'ajout de l'article
     * return date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int détermine la date de création de l'article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param int récupère la date de maj de l'article
     * return date
     */
    public function getUpdatedAt()
    {
        return $this->getUpdatedAt;
    }

    /**
     * @param int détermine la date de maj de l'article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setUpdatedAt = $updatedAt;
    }

    /**
     * @param int $id Renvoi l'id de l'article dynamiquement
     */
    public function getURL()
    {
        return '/?page=article&id=' . $this->getId();
    }

    public function getExcerpt()
    {
        $html= '<p>' . substr($this->content, 0, 700) . '...</p>';
        //$html .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';
        return $html;
    } 
    
}
