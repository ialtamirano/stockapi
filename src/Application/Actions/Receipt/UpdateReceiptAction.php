<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateReceiptAction extends ReceiptAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $receiptId = (int) $this->resolveArg('id');
        $receipt = $this->getFormData();
       
        $receipt->id = $this->receiptRepository->update($receiptId,$receipt);

        $this->logger->info("Receipt of id `$receipt->id` was updated.");

        return $this->respondWithData($receipt);
    }
}
