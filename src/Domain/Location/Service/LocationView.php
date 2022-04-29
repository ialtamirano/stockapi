<?php


namespace App\Domain\Location\Service;

use App\Domain\Location\Repository\LocationRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class LocationView
{
    /**
     * @var LocationRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LocationRepository $repository The repository
     */
    public function __construct(LocationRepository $repository)
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