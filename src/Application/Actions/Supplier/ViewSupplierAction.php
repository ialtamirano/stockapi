<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier; 
//

use Psr\Http\Message\ResponseInterface as Response;

class ViewSupplierAction extends SupplierAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $supplierId = (int) $this->resolveArg('id');
        $supplier = $this->supplierRepository->findById($supplierId);

        $this->logger->info("Supplier of id `${supplierId}` was viewed.");

        return $this->respondWithData($supplier);
    }
}
