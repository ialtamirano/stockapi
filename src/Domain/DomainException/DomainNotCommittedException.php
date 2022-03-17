<?php
declare(strict_types=1);

namespace App\Domain\DomainException;



class DomainNotCommittedException extends DomainException
{
    public $message = 'La transaccion no se pudo ejecutar';
}
