<?php


namespace App\Domain\PartNumber\Service;

use App\Domain\PartNumber\Repository\PartNumberRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class PartNumberCreate
{
    /**
     * @var PartNumberRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PartNumberRepository $repository The repository
     */
    public function __construct(PartNumberRepository $repository)
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
        if($this->partNumberExist($data->code) )
        { 
            throw new DomainValidationException("El numero de parte ya existe!", []);     
        }

      
        // Create account
        $partNumberId = $this->repository->create($data);

        return $partNumberId;
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

        if (empty($data->code)) {
            $errors['code'] = 'El código  es requerido!';
        }


        if (empty($data->name)) {
            $errors['name'] = 'El nombre es requerido!';
        }

        if (empty($data->description)) {
            $errors['description'] = 'La descripción es requerido!';
        }

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function partNumberExist($partNumberCode)
    {
        $result =  $this->repository->findByCode($partNumberCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}