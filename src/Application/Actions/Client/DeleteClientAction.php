<?php
declare(strict_types=1);

namespace App\Application\Actions\Client;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteClientAction extends ClientAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $ClientId = (int) $this->resolveArg('id');
        $Client = $this->clientRepository->delete($ClientId);

        $this->logger->info("Client of id `${ClientId}` was deleted.");

        return $this->respondWithData($Client);
    }
}
