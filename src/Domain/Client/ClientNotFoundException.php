<?php
declare(strict_types=1);

namespace App\Domain\Client;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ClientNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The client you requested does not exist.';
}
