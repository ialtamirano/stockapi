<?php


namespace App\Domain\Comment\Service;

use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CommentView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $comment= $this->repository->findById($id);

        return $comment;
    }

  


    
   
}