<?php
declare(strict_types=1);

namespace App\Application\Actions\Client;

use Psr\Http\Message\ResponseInterface as Response;

class ListClientAction extends ClientAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $clients = $this->clientRepository->findAll();

        $this->logger->info("Client list was viewed.");

        return $this->respondWithData($clients);
    }
}
