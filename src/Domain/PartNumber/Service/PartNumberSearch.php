<?php


namespace App\Domain\PartNumber\Service;

use App\Domain\PartNumber\Repository\PartNumberRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class PartNumberSearch
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PartNumberRepository $repository The repository
     */
    public function __construct(PartNumberRepository $repository)
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
        $partNumbers = $this->repository->search($query);

        return $partNumbers;
    }

   
}