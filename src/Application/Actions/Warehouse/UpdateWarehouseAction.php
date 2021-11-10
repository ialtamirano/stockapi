<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateWarehouseAction extends WarehouseAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $warehouseId = (int) $this->resolveArg('id');
        $warehouse = $this->getFormData();
       
        $warehouse->id = $this->warehouseRepository->update($warehouseId,$warehouse);

        $this->logger->info("Warehouse of id `$warehouse->id` was updated.");

        return $this->respondWithData($warehouse);
    }
}
