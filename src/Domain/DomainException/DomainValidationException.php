<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

use RuntimeException;
use Throwable;

final class DomainValidationException extends RuntimeException
{
    private $errors;

    public function __construct(
        string $message, 
        array $errors = [], 
        int $code = 422, 
        Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);

        $this->errors = $errors;
        $this->message = $message.' - '. implode("\\r\\n",$errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}