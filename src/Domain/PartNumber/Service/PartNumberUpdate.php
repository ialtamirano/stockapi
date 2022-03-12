<?php


namespace App\Domain\PartNumber\Service;

use App\Domain\PartNumber\Repository\PartNumberRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class PartNumberUpdate
{
    /**
     * @var PartNumberRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PartNumberRepository $repository The repository
     */
    public function __construct(PartNumberRepository $repository)
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
        $partNumberId = $this->repository->update($id,$data);

        return $partNumberId;
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

        if (empty($data->description)) {
            $errors['description'] = 'La descripción es requerido!';
        }

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    
   
}