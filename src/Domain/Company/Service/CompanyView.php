<?php


namespace App\Domain\Company\Service;

use App\Domain\Company\Repository\CompanyRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CompanyView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $data= $this->repository->findById($id);

        return $data;
    }

  


    
   
}