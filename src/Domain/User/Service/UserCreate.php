<?php


namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class UserCreate
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
     * Create a new account.
     *
     * @param array $data The form data
     *
     * @return int The new account ID
     */
    public function create($data): int
    {
        // Input validation
        $this->validateNew($data);

        // Part Number exist validation
        if($this->userExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de usuario ya existe!", []);     
        }

      
        // Create account
        $userId = $this->repository->create($data);

        return $userId;
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
    private function validateNew($data): void
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


    private function userExist($userCode)
    {
        $result =  $this->repository->findByCode($userCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}