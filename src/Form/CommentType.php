<?php

namespace App\Form;

use App\Service\ValidationService;

class CommentType implements FormInterface
{

    const PSEUDO_INVALID = "Renseignez un pseudo";
    const CONTENT_INVALID = "Renseignez un message";

    public function isValid()
    {
        $validationService = new ValidationService();
        if ($validationService->varPostisValid('pseudo') && $validationService->varPostisValid('content')) {
            return true;
        }
    }

  
    public function notValid()
    {
        $validationService = new ValidationService();
        $notValid = $validationService->varPostNotValid('pseudo');
        if ($notValid === true) {
            $this->addError(self::PSEUDO_INVALID);
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