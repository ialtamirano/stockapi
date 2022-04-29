<?php


namespace App\Domain\Warehouse\Service;

use App\Domain\Warehouse\Repository\WarehouseRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class WarehouseList
{
    /**
     * @var Authentication
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
     * Create a new account.
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function findAll(): array
    {
       
      
        // Create account
        $data = $this->repository->findAll();

        return $data;
    }

   
}