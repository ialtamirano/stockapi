<?php
declare(strict_types=1);

namespace App\Application\Actions\Account;

use App\Application\Actions\Action;
use App\Domain\Account\AccountRepository;
use Psr\Log\LoggerInterface;

abstract class AccountAction extends Action
{
    /**
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * @param LoggerInterface $logger
     * @param AccountRepository $accountRepository
     */
    public function __construct(
        LoggerInterface $logger,
        AccountRepository $accountRepository
    ) {
        parent::__construct($logger);
        $this->accountRepository = $accountRepository;
    }
}
