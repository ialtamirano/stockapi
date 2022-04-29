<?php


namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ReceiptSearch
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ReceiptRepository $repository The repository
     */
    public function __construct(ReceiptRepository $repository)
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