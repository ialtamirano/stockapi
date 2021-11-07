<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateSupplierAction extends SupplierAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $supplierId = (int) $this->resolveArg('id');
        $supplier = $this->getFormData();
       
        $supplier->id = $this->supplierRepository->update($supplierId,$supplier);

        $this->logger->info("Supplier of id `$supplier->id` was updated.");

        return $this->respondWithData($supplier);
    }
}
