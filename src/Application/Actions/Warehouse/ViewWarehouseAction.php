<?php
declare(strict_types=1);

namespace App\Application\Actions\Warehouse; 
//

use Psr\Http\Message\ResponseInterface as Response;

class ViewWarehouseAction extends WarehouseAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $warehouseId = (int) $this->resolveArg('id');
        $warehouse = $this->warehouseRepository->findById($warehouseId);

        $this->logger->info("Warehouse of id `${warehouseId}` was viewed.");

        return $this->respondWithData($warehouse);
    }
}
