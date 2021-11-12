<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class CreateUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $User = $this->getFormData();
       
        $User->id = $this->userRepository->create($User);

        $this->logger->info("User of id `$User->id` was created.");

        return $this->respondWithData($User);
    }
}
