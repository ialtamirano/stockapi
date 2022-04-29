<?php


namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class StreamUpdate
{
    /**
     * @var StreamRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param StreamRepository $repository The repository
     */
    public function __construct(StreamRepository $repository)
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
    public function update($id,$data): int
    {
        // Input validation
        $this->validate($data);


      
        // Update account
        $Id = $this->repository->update($id,$data);

        return $Id;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws DomainValidationException
     *
     * @return void
     */
    private function validate($data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data->code)) {
            $errors['code'] = 'El código  es requerido!';
        }


        

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    
   
}