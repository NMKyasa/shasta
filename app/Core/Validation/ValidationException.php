<?php

namespace App\Core\Validation;

use Exception;

class ValidationException
    extends Exception
{
    protected array $errors = [];

    public function __construct(
        array $errors
    )
    {
        parent::__construct(
            'Validation failed.'
        );

        $this->errors =
            $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}