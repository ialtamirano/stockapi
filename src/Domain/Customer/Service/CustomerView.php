<?php


namespace App\Domain\Customer\Service;

use App\Domain\Customer\Repository\CustomerRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CustomerView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $customer= $this->repository->findById($id);

        return $customer;
    }

  


    
   
}