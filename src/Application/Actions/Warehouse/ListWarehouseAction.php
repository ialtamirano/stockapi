<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use Psr\Http\Message\ResponseInterface as Response;

class ListWarehouseAction extends WarehouseAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $Warehouse = $this->WarehouseRepository->findAll();

        $this->logger->info("Warehouse list was viewed.");

        return $this->respondWithData($Warehouse);
    }
}
