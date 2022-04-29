<?php


namespace App\Domain\Scope\Service;

use App\Domain\Scope\Repository\ScopeRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ScopeSearch
{
    /**
     * @var Authentication
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