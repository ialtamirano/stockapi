<?php
declare(strict_types=1);

namespace App\Domain\Scope;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ScopeNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Scope you requested does not exist.....';
}
