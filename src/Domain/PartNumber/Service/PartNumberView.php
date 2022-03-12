<?php


namespace App\Domain\PartNumber\Service;

use App\Domain\PartNumber\Repository\PartNumberRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class PartNumberView
{
    /**
     * @var PartNumberRepository
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
        $partNumber= $this->repository->findById($id);

        return $partNumber;
    }

  


    
   
}