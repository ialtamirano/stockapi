<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use Psr\Http\Message\ResponseInterface as Response;

class ListStreamAction extends StreamAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $Supplier = $this->streamRepository->findAll();

        $this->logger->info("Supplier list was viewed.");

        return $this->respondWithData($Supplier);
    }
}
