<?php


namespace App\Domain\Warehouse\Service;

use App\Domain\Warehouse\Repository\WarehouseRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class WarehouseUpdate
{
    /**
     * @var WarehouseRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param WarehouseRepository $repository The repository
     */
    public function __construct(WarehouseRepository $repository)
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


    
   
}