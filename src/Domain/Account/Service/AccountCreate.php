<?php


namespace App\Domain\Account\Service;

use App\Domain\Account\Repository\AccountRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class AccountCreate
{
    /**
     * @var AccountRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AccountRepository $repository The repository
     */
    public function __construct(AccountRepository $repository)
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
        if($this->accountExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de account ya existe!", []);     
        }

      
        // Create account
        $accountId = $this->repository->create($data);

        return $accountId;
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


        
      

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function accountExist($accountCode)
    {
        $result =  $this->repository->findByCode($accountCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}