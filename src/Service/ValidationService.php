<?php

namespace App\Service;

class ValidationService
{
    /**
    * This method test if the $variable $_POST[$variable] is valid
    * @param string $variable If $_POST[$variable] isset and not empty
    * @return bool Returns true or false
    */
    public function varPostIsValid($variable)
    {
        $isValid = false;
        if (isset($_POST[$variable])) {
            return !empty($_POST[$variable]);
        }
        return $isValid;
    }

    /**
     * This method test if the $variable $_POST[$variable] isn't valid
     * @param string $variable If $_POST[$variable] isset and empty
     * @return bool Returns true or false
     */
    public function varPostNotValid($variable)
    {
        $notValid = false;
        if (isset($_POST[$variable])) {
            return empty($_POST[$variable]);
        }
        return $notValid;
    }

    /**
     * This method test if the var given is correct
     * @param mixed $variable
     * @return bool|true
     */
    public function varIsValid($variable)
    {
        if (isset($variable)) {
            !empty($variable);
        }
        return true;
    }
}
