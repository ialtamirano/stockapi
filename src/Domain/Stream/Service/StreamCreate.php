<?php


namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class StreamCreate
{
    /**
     * @var StreamRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param StreamRepository $repository The repository
     */
    public function __construct(StreamRepository $repository)
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
        if($this->streamExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de stream ya existe!", []);     
        }

      
        // Create account
        $streamId = $this->repository->create($data);

        return $streamId;
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


    private function streamExist($streamCode)
    {
        $result =  $this->repository->findByCode($streamCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}