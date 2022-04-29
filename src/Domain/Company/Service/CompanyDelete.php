<?php


namespace App\Domain\Company\Service;

use App\Domain\Company\Repository\CompanyRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CompanyDelete
{
    /**
     * @var CompanyRepository
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