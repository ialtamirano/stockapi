<?php
declare(strict_types=1);
//

namespace App\Application\Actions\user;

use Psr\Http\Message\ResponseInterface as Response;

class ListuserAction extends userAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $user = $this->userRepository->findAll();

        $this->logger->info("user list was viewed.");

        return $this->respondWithData($user);
    }
}
