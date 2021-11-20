<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use App\Application\Actions\Action;
use App\Domain\Customer\CustomerRepository;
use Psr\Log\LoggerInterface;

abstract class CustomerAction extends Action
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @param LoggerInterface $logger
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        LoggerInterface $logger,
        CustomerRepository $customerRepository
    ) {
        parent::__construct($logger);
        $this->customerRepository = $customerRepository;
    }
}
