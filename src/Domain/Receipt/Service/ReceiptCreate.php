<?php


namespace App\Domain\Receipt\Service;

use App\Domain\Receipt\Repository\ReceiptRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class ReceiptCreate
{
    /**
     * @var ReceiptRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ReceiptRepository $repository The repository
     */
    public function __construct(ReceiptRepository $repository)
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
        if($this->receiptExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de recibo ya existe!", []);     
        }

      
        // Create account
        $receiptId = $this->repository->create($data);

        return $receiptId;
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
            $errors['code'] = 'El codigo  es requerido!';
        }


        if (empty($data->subject)) {
            $errors['subject'] = 'El titulo es requerido!';
        }

     

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function receiptExist($receiptCode)
    {
        $result =  $this->repository->findByCode($receiptCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}