<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\Service\InboxUpdate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class UpdateInboxAction extends Action
{

    
    private $inboxUpdate;

    public function __construct( LoggerInterface $logger,InboxUpdate $inboxUpdate)
    {
        parent::__construct($logger);
       
        $this->inboxUpdate = $inboxUpdate;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inboxFormData = $this->getFormData();
        $inboxId = (int) $this->resolveArg('id');

        $inboxFormData->id = $this->inboxUpdate->update($inboxId,$inboxFormData);

        $this->logger->info("Inbox of id ".$inboxFormData->id." was updated successfully.");

        return $this->respondWithData($inboxFormData);
    }
}
