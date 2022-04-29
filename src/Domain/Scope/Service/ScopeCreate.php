<?php


namespace App\Domain\Scope\Service;

use App\Domain\Scope\Repository\ScopeRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ScopeCreate
{
    /**
     * @var ScopeRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ScopeRepository $repository The repository
     */
    public function __construct(ScopeRepository $repository)
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
        if($this->scopeExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de scope ya existe!", []);     
        }

      
        // Create account
        $scopeId = $this->repository->create($data);

        return $scopeId;
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

      

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function scopeExist($scopeCode)
    {
        $result =  $this->repository->findByCode($scopeCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}