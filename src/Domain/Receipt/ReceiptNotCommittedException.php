<?php
declare(strict_types=1);

namespace App\Domain\Receipt;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ReceiptNotCommittedException extends DomainRecordNotFoundException
{
    public $message = 'The receipt cannot be created.';
}
