<?php


namespace App\Domain\Requisition\Service;

use App\Domain\Requisition\Repository\RequisitionRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class RequisitionList
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param RequisitionRepository $repository The repository
     */
    public function __construct(RequisitionRepository $repository)
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