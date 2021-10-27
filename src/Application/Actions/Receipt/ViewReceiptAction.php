<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use Psr\Http\Message\ResponseInterface as Response;

class ViewReceiptAction extends ReceiptAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $receiptId = (int) $this->resolveArg('id');
        $receipt = $this->receiptRepository->findById($receiptId);
        $this->logger->info("Receipt of id `${receiptId}` was viewed.");

        return $this->respondWithData($receipt);
    }
}
