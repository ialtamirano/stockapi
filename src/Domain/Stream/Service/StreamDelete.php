<?php


namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class StreamDelete
{
    /**
     * @var StreamRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param StreamRepository $repository The repository
     */
    public function __construct(StreamRepository $repository)
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