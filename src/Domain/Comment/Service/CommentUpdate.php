<?php


namespace App\Domain\Comment\Service;

use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class CommentUpdate
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
        $Id = $this->repository->update($id,$data);

        return $Id;
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


    
   
}