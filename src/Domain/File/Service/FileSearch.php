<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class FileSearch
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param FileRepository $repository The repository
     */
    public function __construct(FileRepository $repository)
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