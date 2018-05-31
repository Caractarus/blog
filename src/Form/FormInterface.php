<?php // Receuil de fonctions pour les formulaires nécessaires à la classe

namespace App\Form;

/**
 * 
 */
interface FormInterface
{

    /**
     * This method check if the data required by the Form are correct or not
     *
     * @param string Should contain a data
     *
     * @param bool Returns true if the $_POST[$data] are correct
     */
    public function isValid();

    /**
     * This method check which data are not correct and add them into an array
     *
     * @param bool $notValid Returns true is an error is detected
     *
     * @param string $this->addError($error) Add the pointed $error into the array
     *
     * @return array Returns the $error
     */
    public function notValid();
}
