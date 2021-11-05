<?php
declare(strict_types=1);

namespace App\Domain\Inbox;

use App\Domain\DomainException\DomainRecordNotFoundException;

class InboxNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Inbox message you requested does not exist.';
}
