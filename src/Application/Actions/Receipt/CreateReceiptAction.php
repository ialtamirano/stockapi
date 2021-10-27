<?php
declare(strict_types=1);

namespace App\Application\Actions\Receipt;

use Psr\Http\Message\ResponseInterface as Response;

class CreateReceiptAction extends ReceiptAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $receipt = $this->getFormData();
       
        $receipt->id = $this->receiptRepository->create($receipt);

        $this->logger->info("Receipt of id `$receipt->id` was created.");

        return $this->respondWithData($receipt);
    }
}
