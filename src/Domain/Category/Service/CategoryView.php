<?php


namespace App\Domain\Category\Service;

use App\Domain\Category\Repository\CategoryRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CategoryView
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CategoryRepository $repository The repository
     */
    public function __construct(CategoryRepository $repository)
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