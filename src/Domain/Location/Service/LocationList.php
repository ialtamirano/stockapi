<?php


namespace App\Domain\Location\Service;

use App\Domain\Location\Repository\LocationRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class LocationList
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LocationRepository $repository The repository
     */
    public function __construct(LocationRepository $repository)
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