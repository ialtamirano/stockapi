<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateInboxAction extends InboxAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inboxId = (int) $this->resolveArg('id');
        $inbox = $this->getFormData();
       
        $inbox->id = $this->inboxRepository->update($inboxId,$inbox);

        $this->logger->info("Inbox of id `$inbox->id` was updated.");

        return $this->respondWithData($inbox);
    }
}
