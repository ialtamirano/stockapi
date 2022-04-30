<?php
declare(strict_types=1);

namespace App\Application\Actions\Client;

use Psr\Http\Message\ResponseInterface as Response;

class CreateClientAction extends ClientAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $Client = $this->getFormData();

        
       
        $Client->id = $this->clientRepository->create($Client);

        $this->logger->info("Client of id `$Client->id` was created.");

        return $this->respondWithData($Client);
    }
}
