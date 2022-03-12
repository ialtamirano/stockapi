<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\Service\InboxList;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class ListInboxAction extends Action
{

    
    private $inboxList;

    public function __construct(LoggerInterface $logger,InboxList $inboxList)
    {
        parent::__construct($logger);
       
        $this->inboxList = $inboxList;
    }


    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $inboxData = $this->inboxList->findAll();

        return $this->respondWithData($inboxData);
    }
}
