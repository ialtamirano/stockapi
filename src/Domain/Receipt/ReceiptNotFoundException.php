<?php
declare(strict_types=1);

namespace App\Domain\Receipt;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ReceiptNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The receipt you requested does not exist.';
}
