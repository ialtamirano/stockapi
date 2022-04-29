<?php


namespace App\Domain\Company\Service;

use App\Domain\Company\Repository\CompanyRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CompanyCreate
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CompanyRepository $repository The repository
     */
    public function __construct(CompanyRepository $repository)
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
        if($this->companyExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de compañia ya existe!", []);     
        }

      
        // Create account
        $companyId = $this->repository->create($data);

        return $companyId;
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


    private function companyExist($companyCode)
    {
        $result =  $this->repository->findByCode($companyCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}