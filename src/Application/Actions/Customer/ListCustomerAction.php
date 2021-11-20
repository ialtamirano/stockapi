<?php
declare(strict_types=1);

namespace App\Application\Actions\Customer;

use Psr\Http\Message\ResponseInterface as Response;

class ListCustomerAction extends CustomerAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $customers = $this->customerRepository->findAll();

        $this->logger->info("Customer list was viewed.");

        return $this->respondWithData($customers);
    }
}
