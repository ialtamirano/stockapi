<?php


namespace App\Domain\Location\Service;

use App\Domain\Location\Repository\LocationRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class LocationCreate
{
    /**
     * @var LocationRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LocationRepository $repository The repository
     */
    public function __construct(LocationRepository $repository)
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
        if($this->locationExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de locación ya existe!", []);     
        }

      
        // Create account
        $locationId = $this->repository->create($data);

        return $locationId;
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

        if (empty($data->phone)) {
            $errors['phone'] = 'El telefono es requerido!';
        }

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function locationExist($locationCode)
    {
        $result =  $this->repository->findByCode($locationCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}