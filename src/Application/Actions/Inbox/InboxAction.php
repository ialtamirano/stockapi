<?php
declare(strict_types=1);

namespace App\Application\Actions\Inbox;

use App\Application\Actions\Action;
use App\Domain\Inbox\InboxRepository;
use Psr\Log\LoggerInterface;

abstract class InboxAction extends Action
{
    /**
     * @var InboxRepository
     */
    protected $inboxRepository;

    /**
     * @param LoggerInterface $logger
     * @param InboxRepository $inboxRepository
     */
    public function __construct(
        LoggerInterface $logger,
        InboxRepository $inboxRepository
    ) {
        parent::__construct($logger);
        $this->inboxRepository = $inboxRepository;
    }
}
