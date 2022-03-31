<?php


namespace App\Domain\Comment\Service;

use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CommentDelete
{
    /**
     * @var CommentRepository
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
        $commentId = $this->repository->delete($id);

        return $commentId;
    }

  


    
   
}