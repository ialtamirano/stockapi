<?php


namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class StreamSearch
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
    public function search($query): array
    {
       
      
        // Create account
        $data = $this->repository->search($query);

        return $data;
    }

   
}