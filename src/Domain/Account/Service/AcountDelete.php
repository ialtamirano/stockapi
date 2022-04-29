<?php


namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class AccountDelete
{
    /**
     * @var AccountRepository
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
     * Update a new account.
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function delete($id): bool
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $Id = $this->repository->delete($id);

        return $Id;
    }

  


    
   
}