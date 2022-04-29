<?php


namespace App\Domain\Warehouse\Service;

use App\Domain\Warehouse\Repository\WarehouseRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class WarehouseCreate
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
        if($this->warehouseExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de almacen ya existe!", []);     
        }

      
        // Create account
        $warehouseId = $this->repository->create($data);

        return $warehouseId;
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


    private function warehouseExist($warehouseCode)
    {
        $result =  $this->repository->findByCode($warehouseCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}