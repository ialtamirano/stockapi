<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCustomerAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $customerId = (int) $this->resolveArg('id');
        $customer = $this->customerRepository->findById($customerId);

        $this->logger->info("Customer of id `${customerId}` was viewed.");

        return $this->respondWithData($customer);
    }
}
