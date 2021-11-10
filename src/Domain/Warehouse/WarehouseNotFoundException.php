<?php
declare(strict_types=1);

namespace App\Domain\Warehouse;

use App\Domain\DomainException\DomainRecordNotFoundException;

class WarehouseNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Warehouse you requested does not exist.....';
}
