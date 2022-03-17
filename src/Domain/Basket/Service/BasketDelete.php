<?php


namespace App\Domain\Basket\Service;

use App\Domain\Basket\Repository\BasketRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class BasketDelete
{
    /**
     * @var BasketRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param BasketRepository $repository The repository
     */
    public function __construct(BasketRepository $repository)
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
        $Id = $this->repository->delete($id);

        return $Id;
    }

  


    
   
}