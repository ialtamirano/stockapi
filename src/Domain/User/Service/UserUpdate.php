<?php


namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class UserUpdate
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserRepository $repository The repository
     */
    public function __construct(UserRepository $repository)
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

        if (empty($data->username)) {
            $errors['username'] = 'El username  es requerido!';
        }


        if (empty($data->firstName)) {
            $errors['firstName'] = 'El primer nombre es requerido!';
        }

        if (empty($data->lastName)) {
            $errors['lastName'] = 'El apellido es requerido!';
        }

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    
   
}