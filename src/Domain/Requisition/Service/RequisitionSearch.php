<?php


namespace App\Domain\Requisition\Service;

use App\Domain\Requisition\Repository\RequisitionRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class RequisitionSearch
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
    public function search($query): array
    {
       
      
        // Create account
        $comments = $this->repository->search($query);

        return $comments;
    }

   
}