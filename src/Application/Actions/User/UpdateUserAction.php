<?php
declare(strict_types=1);
//alex
namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $userId = (int) $this->resolveArg('id');
        $user = $this->getFormData();
       
        $user->id = $this->userRepository->update($userId,$user);

        $this->logger->info("user of id `$user->id` was updated.");

        return $this->respondWithData($user);
    }
}
