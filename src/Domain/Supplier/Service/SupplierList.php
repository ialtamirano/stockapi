<?php


namespace App\Domain\Suppplier\Service;

use App\Domain\Suppplier\Repository\SuppplierRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class SuppplierList
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param SuppplierRepository $repository The repository
     */
    public function __construct(SuppplierRepository $repository)
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