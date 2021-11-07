<?php
declare(strict_types=1);

namespace App\Application\Actions\Supplier;

use Psr\Http\Message\ResponseInterface as Response;

class CreateSupplierAction extends SupplierAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $supplier = $this->getFormData();
       
        $supplier->id = $this->supplierRepository->create($supplier);

        $this->logger->info("Supplier of id `$supplier->id` was created.");

        return $this->respondWithData($supplier);
    }
}
