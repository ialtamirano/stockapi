<?php
declare(strict_types=1);

namespace App\Domain\Location;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LocationNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Location you requested does not exist.....';
}
