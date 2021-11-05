<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use Psr\Http\Message\ResponseInterface as Response;

class ListInboxAction extends InboxAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $inboxs = $this->inboxRepository->findAll();

        $this->logger->info("Inbox list was viewed.");

        return $this->respondWithData($inboxs);
    }
}
