<?php


namespace App\Domain\Inbox\Service;

use App\Domain\Inbox\Repository\InboxRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class InboxList
{
    /**
     * @var Authentication
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

   
    public function findAll(): array
    {
       
      
        // Create account
        $inboxData = $this->repository->findAll();

        return $inboxData;
    }

   
}