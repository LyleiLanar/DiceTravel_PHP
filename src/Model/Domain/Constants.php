<?php

namespace App\Model\Domain;

class Constants
{

    const NOT_SCALAR = 'contains NOT acceptable character(s)';
    const MAX_LENGTH = 'contains too much characters';
    const REQUIRED = 'is required';
    const BE_INTEGER = 'is not an integer';
    const INVALID_VISIBILITY = 'contains wrong visibility';

    public static function createValidationErrorMessage(string $field, string $msg): string
    {
        return 'The ' . $field . ' ' . $msg . '!';
    }

}
