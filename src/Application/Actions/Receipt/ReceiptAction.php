<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use App\Application\Actions\Action;
use App\Domain\Receipt\ReceiptRepository;
use Psr\Log\LoggerInterface;

abstract class ReceiptAction extends Action
{
    /**
     * @var ReceiptRepository
     */
    protected $receiptRepository;

    /**
     * @param LoggerInterface $logger
     * @param ReceiptRepository $receiptRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ReceiptRepository $receiptRepository
    ) {
        parent::__construct($logger);
        $this->receiptRepository = $receiptRepository;
    }
}
