<?php


namespace App\Domain\Inbox\Service;

use App\Domain\Inbox\Repository\InboxRepository;
use App\Domain\DomainException\DomainValidationException;


/**
 * Service.
 */
final class InboxUpdate
{
    /**
     * @var InboxRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param InboxRepository $repository The repository
     */
    public function __construct(InboxRepository $repository)
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
        $id = $this->repository->update($id,$data);

        return $id;
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

  

        if (empty($data->subject)) {
            $errors['subject'] = 'El tituo es requerido!';
        }

        if (empty($data->body)) {
            $errors['body'] = 'El cuerpo del mensaje es requerido!';
        }

        if ($errors) {
            throw new DomainValidationException('Por favor verifique los datos de captura!', $errors);
        }
    }


    
   
}