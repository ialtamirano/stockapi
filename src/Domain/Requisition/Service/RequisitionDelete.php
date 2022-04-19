<?php


namespace App\Domain\Requisition\Service;

use App\Domain\Requisition\Repository\RequisitionRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class RequisitionDelete
{
    /**
     * @var RequisitionRepository
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