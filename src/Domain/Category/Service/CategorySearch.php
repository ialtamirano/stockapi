<?php


namespace App\Domain\Category\Service;

use App\Domain\Category\Repository\CategoryRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CategorySearch
{
    /**
     * @var Authentication
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