<?php


namespace App\Domain\Scope\Service;

use App\Domain\Scope\Repository\ScopeRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ScopeDelete
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
    public function delete($id): bool
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $Id = $this->repository->delete($id);

        return $Id;
    }

  


    
   
}