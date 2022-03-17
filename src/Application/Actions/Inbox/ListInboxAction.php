<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\Service\InboxList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListInboxAction extends Action
{

    
    private $service;

    public function __construct(LoggerInterface $logger,InboxList $service)
    {
        parent::__construct($logger);
       
        $this->service = $service;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inboxData = $this->service->findAll();

        return $this->respondWithData($inboxData);
    }
}
