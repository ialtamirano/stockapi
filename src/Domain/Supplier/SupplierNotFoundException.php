<?php
declare(strict_types=1);

namespace App\Domain\Supplier;

use App\Domain\DomainException\DomainRecordNotFoundException;

class SupplierNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Supplier you requested does not exist.....';
}
