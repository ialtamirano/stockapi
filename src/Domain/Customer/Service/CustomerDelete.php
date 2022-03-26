<?php


namespace App\Domain\Customer\Service;

use App\Domain\Customer\Repository\CustomerRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CustomerDelete
{
    /**
     * @var CustomerRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CustomerRepository $repository The repository
     */
    public function __construct(CustomerRepository $repository)
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
        $customerId = $this->repository->delete($id);

        return $customerId;
    }

  


    
   
}