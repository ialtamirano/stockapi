<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class FileView
{
    /**
     * @var FileRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param FileRepository $repository The repository
     */
    public function __construct(FileRepository $repository)
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
        $file= $this->repository->findById($id);

        return $file;
    }

  


    
   
}