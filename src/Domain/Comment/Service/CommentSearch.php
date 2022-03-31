<?php


namespace App\Domain\Comment\Service;

use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CommentSearch
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CommentRepository $repository The repository
     */
    public function __construct(CommentRepository $repository)
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