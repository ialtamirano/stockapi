<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class FileList
{
    /**
     * @var Authentication
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param FileRepository $repository The repository
     */
    public function __construct(FileRepository $repository)
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
    public function findAll($data): array
    {
       
        $this->validate($data);

        // Create account
        $files = $this->repository->findAll($data->entity_name, $data->entity_id);
        return $files;
    }


    private function validate($data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data->entity_name)) {
            $errors['entity_name'] = 'El código de transaccion es requerido!';
        }

        if (empty($data->entity_id)) {
            $errors['entity_id'] = 'El Id de transaccion es requerido!';
        }

        

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }

   
}