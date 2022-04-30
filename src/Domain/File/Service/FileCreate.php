<?php


namespace App\Domain\File\Service;

use App\Domain\File\Repository\FileRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class FileCreate
{
    /**
     * @var FileRepository
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
    public function create($data): int
    {
        // Input validation
        $this->validateNew($data);

        // Part Number exist validation
        /*if($this->fileExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de cliente ya existe!", []);     
        }
*/
      
        // Create account
        $fileId = $this->repository->create($data);

        return $fileId;
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

        if (empty($data->entity_name)) {
            $errors['entity_name'] = 'El código de transaccion es requerido!';
        }

        if (empty($data->entity_id)) {
            $errors['entity_id'] = 'El Id de transaccion es requerido!';
        }


        if (empty($data->name)) {
            $errors['name'] = 'El nombre  del archivo es requerido!';
        }

        

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function fileExist($fileCode)
    {
        $result =  $this->repository->findByCode($fileCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}