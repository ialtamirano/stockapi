<?php


namespace App\Domain\Company\Service;

use App\Domain\Company\Repository\CompanyRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CompanyList
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CompanyRepository $repository The repository
     */
    public function __construct(CompanyRepository $repository)
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