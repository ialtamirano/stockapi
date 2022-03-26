<?php


namespace App\Domain\Customer\Service;

use App\Domain\Customer\Repository\CustomerRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CustomerCreate
{
    /**
     * @var CustomerRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CustomerRepository $repository The repository
     */
    public function __construct(CustomerRepository $repository)
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
        if($this->customerExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de cliente ya existe!", []);     
        }

      
        // Create account
        $customerId = $this->repository->create($data);

        return $customerId;
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


    private function customerExist($customerCode)
    {
        $result =  $this->repository->findByCode($customerCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}