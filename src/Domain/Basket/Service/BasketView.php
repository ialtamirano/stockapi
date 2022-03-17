<?php


namespace App\Domain\Basket\Service;

use App\Domain\Basket\Repository\BasketRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class BasketView
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
    public function view($id)
    {
        // Input validation
        //$this->validate($data);


      
        // Update account
        $data= $this->repository->findById($id);

        return $data;
    }

  


    
   
}