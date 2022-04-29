<?php


namespace App\Domain\Supplier\Service;

use App\Domain\Supplier\Repository\SupplierRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class SupplierCreate
{
    /**
     * @var SupplierRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param SupplierRepository $repository The repository
     */
    public function __construct(SupplierRepository $repository)
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
        if($this->supplierExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de proveedor ya existe!", []);     
        }

      
        // Create account
        $supplierId = $this->repository->create($data);

        return $supplierId;
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


    private function supplierExist($supplierCode)
    {
        $result =  $this->repository->findByCode($supplierCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}