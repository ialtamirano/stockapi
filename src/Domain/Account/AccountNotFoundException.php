<?php
declare(strict_types=1);

namespace App\Domain\Account;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AccountNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Account you requested does not exist.....';
}
