<?php


namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class AccountSearch
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AccountRepository $repository The repository
     */
    public function __construct(AccountRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new account.
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function search($query): array
    {
       
      
        // Create account
        $data = $this->repository->search($query);

        return $data;
    }

   
}