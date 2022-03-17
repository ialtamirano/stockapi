<?php


namespace App\Domain\Basket\Service;

use App\Domain\Basket\Repository\BasketRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class BasketList
{
    /**
     * @var Authentication
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