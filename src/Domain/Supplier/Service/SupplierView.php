<?php


namespace App\Domain\Supplier\Service;

use App\Domain\Supplier\Repository\SupplierRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class SupplierView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $data= $this->repository->findById($id);

        return $data;
    }

  


    
   
}