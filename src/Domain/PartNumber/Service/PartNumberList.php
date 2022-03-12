<?php


namespace App\Domain\PartNumber\Service;

use App\Domain\PartNumber\Repository\PartNumberRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class PartNumberList
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
    public function findAll(): array
    {
       
      
        // Create account
        $partNumbers = $this->repository->findAll();

        return $partNumbers;
    }

   
}