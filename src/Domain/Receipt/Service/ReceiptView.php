<?php


namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ReceiptView
{
    /**
     * @var ReceiptRepository
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