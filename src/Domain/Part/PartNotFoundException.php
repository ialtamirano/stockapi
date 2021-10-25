<?php
declare(strict_types=1);

namespace App\Domain\Part;

use App\Domain\DomainException\DomainRecordNotFoundException;

class PartNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Part you requested does not exist.';
}
