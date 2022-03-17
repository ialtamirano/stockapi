<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\Service\InboxCreate;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateInboxAction extends Action
{

    
    private $service;

    public function __construct( LoggerInterface $logger,InboxCreate $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inboxFormData = $this->getFormData();

        $inboxFormData->id = $this->service->create($inboxFormData);

        $this->logger->info("Inbox of id ".$inboxFormData->id." was created successfully.");

        return $this->respondWithData($inboxFormData);
    }
}
