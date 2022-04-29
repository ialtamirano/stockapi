<?php


namespace App\Domain\Warehouse\Service;

use App\Domain\Warehouse\Repository\WarehouseRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class WarehouseDelete
{
    /**
     * @var WarehouseRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param WarehouseRepository $repository The repository
     */
    public function __construct(WarehouseRepository $repository)
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