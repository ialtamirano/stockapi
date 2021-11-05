<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use Psr\Http\Message\ResponseInterface as Response;

class ViewInboxAction extends InboxAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $inboxId = (int) $this->resolveArg('id');
        $inbox = $this->inboxRepository->findById($inboxId);

        $this->logger->info("Inbox of id `${inboxId}` was viewed.");

        return $this->respondWithData($inbox);
    }
}
