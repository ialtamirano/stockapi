<?php
declare(strict_types=1);

namespace App\Domain\DomainException;

use App\Domain\DomainException\DomainRecordNotFoundException;

class DomainSearchResultNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'No se encontrarón resultados para su busqueda';
}
