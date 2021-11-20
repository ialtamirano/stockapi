<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class CreateCustomerAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $customer = $this->getFormData();
       
        $customer->id = $this->customerRepository->create($customer);

        $this->logger->info("Customer of id `$customer->id` was created.");

        return $this->respondWithData($customer);
    }
}
