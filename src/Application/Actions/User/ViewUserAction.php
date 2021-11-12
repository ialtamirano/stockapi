<?php
declare(strict_types=1);

namespace App\Application\Actions\User; 
//purebaaa

use Psr\Http\Message\ResponseInterface as Response;

class ViewUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        $user = $this->userRepository->findById($userId);

        $this->logger->info("user of id `${userId}` was viewed.");

        return $this->respondWithData($user);
    }
}
