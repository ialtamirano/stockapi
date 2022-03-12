<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\Service\InboxView;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ViewInboxAction extends Action
{

    
    private $inboxView;

    public function __construct( LoggerInterface $logger,InboxView $inboxView)
    {
        parent::__construct($logger);
       
        $this->inboxView = $inboxView;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        
        $inboxId = (int) $this->resolveArg('id');

        $inboxFormData = $this->inboxView->view($inboxId);

        $this->logger->info("Inbox of id ".$inboxFormData->id." was updated successfully.");

        return $this->respondWithData($inboxFormData);
    }
}
