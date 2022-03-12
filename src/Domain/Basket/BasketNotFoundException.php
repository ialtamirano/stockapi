<?php
declare(strict_types=1);

namespace App\Domain\Basket;

use App\Domain\DomainException\DomainRecordNotFoundException;

class BasketNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Basket you requested does not exist.';
}
