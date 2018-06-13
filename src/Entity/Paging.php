<?php

namespace App\Entity;

use App\Model\DataBase;

class Paging extends DataBase
{
    /**
     * @var $perPage Description of articles number displayed per pages
     */
    private $perPage;
    
    /**
     * @var $firstOfPage Description of the start chain displaying article number
     */
    private $start;

    /**
     * 
     */
    public function __construct($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * @return int Describe the number of articles listed by pages
     */
    public function getPerPage()
    {
        return $this->perPage;
    }


    /**
     * @param PDO query
     * @param int $total Describe the number of entries worked out from the Table
     * @return int $pageNb Describe the total number of pages
     */
    public function pageNb()
    {
        $req = $this->getPDO()->query('SELECT COUNT(*) AS total FROM articles');
        $data = $req->fetch();
        $total = $data['total'];
        $pageNb = ceil($total/$this->getPerPage());
        return $pageNb;
    }
    
    /**
     * This method allows to get the current page number after checking if isset, not empty and a digits
     * @return int $current Describe the current page
     */
    public function current()
    {
        if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1) {
            if ($_GET['p'] > $this->pageNb()) {
                $current = $this->pageNb();
            } else {
                $current = $_GET['p'];
            }
        } else {
            $current = 1;
        }
        return $current;
    }
       
    /**
     * @return int $firstOfPage use to give the system the row number into the table where it can start reading
     */
    public function start()
    {
        $start = ($this->current()-1)*$this->perPage;
        return $start;
    }
}
