<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use Psr\Http\Message\ResponseInterface as Response;

class ListReceiptAction extends ReceiptAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $receipts = $this->receiptRepository->findAll();

        $this->logger->info("Receipt list was viewed.");

        return $this->respondWithData($receipts);
    }
}
