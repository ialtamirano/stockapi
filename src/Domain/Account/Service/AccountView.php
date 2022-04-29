<?php


namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class AccountView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $data= $this->repository->findById($id);

        return $data;
    }

  


    
   
}