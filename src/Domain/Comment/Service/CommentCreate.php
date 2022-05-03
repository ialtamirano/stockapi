<?php


namespace App\Domain\Comment\Service;

use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CommentCreate
{
    /**
     * @var CommentRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CommentRepository $repository The repository
     */
    public function __construct(CommentRepository $repository)
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
    public function create($data)
    {
        // Input validation
        $this->validateNew($data);

        // Part Number exist validation
        /*if($this->commentExist($data->code) )
        { 
            throw new DomainValidationException("El codigo de cliente ya existe!", []);     
        }
*/
      
        // Create account
         
        $data = $this->repository->create($data);

        return $data;
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


        if (empty($data->text)) {
            $errors['text'] = 'El texto del comentario es requerido!';
        }

        

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    private function commentExist($commentCode)
    {
        $result =  $this->repository->findByCode($commentCode);

        if(!$result)
        {
            return false;
        }
        return true;
    }
   
}