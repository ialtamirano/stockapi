<?php
declare(strict_types=1);

namespace App\Application\Actions\Client;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateClientAction extends ClientAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $clientId = (int) $this->resolveArg('id');
        $client = $this->getFormData();
       
        $client->id = $this->clientRepository->update($clientId,$client);

        $this->logger->info("client of id `$client->id` was updated.");

        return $this->respondWithData($client);
    }
}
