<?php


namespace App\Domain\Supplier\Service;

use App\Domain\Supplier\Repository\SupplierRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class SupplierDelete
{
    /**
     * @var SupplierRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param SupplierRepository $repository The repository
     */
    public function __construct(SupplierRepository $repository)
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