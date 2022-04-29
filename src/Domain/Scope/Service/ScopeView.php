<?php


namespace App\Domain\Scope\Service;

use App\Domain\Scope\Repository\ScopeRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ScopeView
{
    /**
     * @var ScopeRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ScopeRepository $repository The repository
     */
    public function __construct(ScopeRepository $repository)
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