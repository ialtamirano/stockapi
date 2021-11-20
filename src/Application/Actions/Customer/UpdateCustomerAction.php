<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateCustomerAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $customerId = (int) $this->resolveArg('id');
        $customer = $this->getFormData();
       
        $customer->id = $this->customerRepository->update($customerId,$customer);

        $this->logger->info("Customer of id `$customer->id` was updated.");

        return $this->respondWithData($customer);
    }
}
