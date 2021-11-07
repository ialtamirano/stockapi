<?php
declare(strict_types=1);

namespace App\Domain\Stream;

use App\Domain\DomainException\DomainRecordNotFoundException;

class StreamNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Stream you requested does not exist.....';
}
