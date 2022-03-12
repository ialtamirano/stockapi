<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use App\Application\Actions\Action;
//use App\Domain\Account\AccountRepository;
use App\Domain\Account\Service\AccountCreator;
use Psr\Log\LoggerInterface;

abstract class AccountAction extends Action
{
    /**
     * @var AccountCreator
     */
    protected $accountCreator;

    /**
     * @param LoggerInterface $logger
     * @param AccountCreator $accountCreator
     */
    public function __construct(
        LoggerInterface $logger,
        AccountCreator $accountCreator
    ) {
        parent::__construct($logger);
        $this->accountCreator = $accountCreator;
    }
}
