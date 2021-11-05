<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use Psr\Http\Message\ResponseInterface as Response;

class CreateInboxAction extends InboxAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inbox = $this->getFormData();
       
        $inbox->id = $this->inboxRepository->create($inbox);

        $this->logger->info("Inbox of id `$inbox->id` was created.");

        return $this->respondWithData($inbox);
    }
}
