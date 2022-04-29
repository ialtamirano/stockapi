<?php


namespace App\Domain\Supplier\Service;

use App\Domain\Supplier\Repository\SupplierRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class SupplierSearch
{
    /**
     * @var Authentication
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