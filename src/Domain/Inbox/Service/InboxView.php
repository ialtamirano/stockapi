<?php


namespace App\Domain\Inbox\Service;

use App\Domain\Inbox\Repository\InboxRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class InboxView
{
    /**
     * @var InboxRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param InboxRepository $repository The repository
     */
    public function __construct(InboxRepository $repository)
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
        $inbox= $this->repository->findById($id);

        return $inbox;
    }

  


    
   
}