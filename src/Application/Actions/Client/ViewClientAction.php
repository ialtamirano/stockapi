<?php
declare(strict_types=1);

namespace App\Application\Actions\Client;

use Psr\Http\Message\ResponseInterface as Response;

class ViewClientAction extends ClientAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $clientId = (int) $this->resolveArg('id');
        $client = $this->clientRepository->findClientOfId($clientId);

        $this->logger->info("Client of id `${clientId}` was viewed.");

        return $this->respondWithData($client);
    }
}
