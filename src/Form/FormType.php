<?php // 

namespace App\Form;

abstract class FormType
{

    /**
     * @var $error Description of the error
     */
    protected $error;

    /**
     * @param mixed 
     */
    public function __construct() 
    {
        $error = [];
    }

    /**
     * @param mixed Getter of the attribut $error
     * 
     * @return $error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error Define the error to add to the array
     * 
     * @param array Stock the $error
     */
    protected function addError($error)
    {
        $this->error[] = $error;
    }
}