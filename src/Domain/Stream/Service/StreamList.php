<?php


namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class StreamList
{
    /**
     * @var Authentication
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