<?php
declare(strict_types=1);

namespace App\Domain\Category;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CategoryNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Category you requested does not exist.';
}
