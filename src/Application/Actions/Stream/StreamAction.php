<?php
declare(strict_types=1);

namespace App\Application\Actions\Stream;

use App\Application\Actions\Action;
use App\Domain\Stream\StreamRepository;
use Psr\Log\LoggerInterface;

abstract class StreamAction extends Action
{
    /**
     * @var StreamRepository
     */
    protected $streamRepository;

    /**
     * @param LoggerInterface $logger
     * @param StreamRepository $streamRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StreamRepository $streamRepository
    ) {
        parent::__construct($logger);
        $this->streamRepository = $streamRepository;
    }
}
