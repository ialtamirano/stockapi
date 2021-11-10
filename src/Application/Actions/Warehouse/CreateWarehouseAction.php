<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse;

use Psr\Http\Message\ResponseInterface as Response;

class CreateWarehouseAction extends WarehouseAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $warehouse = $this->getFormData();
       
        $warehouse->id = $this->warehouseRepository->create($warehouse);

        $this->logger->info("Warehouse of id `$warehouse->id` was created.");

        return $this->respondWithData($warehouse);
    }
}
