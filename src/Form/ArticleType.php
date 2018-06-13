<?php // Formulaire type

namespace App\Form;

use App\Form\FormType;
use App\Service\ValidationService;

/**
 * 
 */
class ArticleType extends FormType implements FormInterface
{
    /**
     * @var string Constants listing the different errors the form validation may encounter
     */
    const TITLE_INVALID = 'Renseignez un titre';
    const AUTHOR_INVALID = 'Renseignez un nom d\'Auteur';
    const CONTENT_INVALID = 'Renseignez du contenu';

    /**
     * This method check if the data required by the Form are correct or not
     * @param string Should contain a data
     * @param bool Returns true if the $_POST[$data] are correct
     */
    public function isValid()
    {
        $validationService = new ValidationService();
        if ($validationService->varPostisValid('title') && $validationService->varPostisValid('author') && $validationService->varPostisValid('content')) {
            return true;
        }
    }

    /**
     * This method check which data are not correct and add them into an array
     * @param bool $notValid Returns true is an error is detected
     * @param string $this->addError($error) Add the pointed $error into the array
     * @return array Returns the $error
     */
    public function notValid()
    {
        $validationService = new ValidationService();
        $notValid = $validationService->varPostNotValid('title');
        if ($notValid === true) {
            $this->addError(self::TITLE_INVALID);
            //return $errorTitle = $this->getError();
        }
        $notValid = $validationService->varPostNotValid('author');
        if ($notValid === true) {
            $this->addError(self::AUTHOR_INVALID);
            //return $errorTitle = $this->getError();
        }
        $notValid = $validationService->varPostNotValid('content');
        if ($notValid === true) {
            $this->addError(self::CONTENT_INVALID);
            //return $errorTitle = $this->getError();
        }
        return $error = $this->getError();
    }
}
