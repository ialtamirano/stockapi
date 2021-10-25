<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use Psr\Http\Message\ResponseInterface as Response;

class ListCompanyAction extends CompanyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $companies = $this->companyRepository->findAll();

        $this->logger->info("Company list was viewed.");

        return $this->respondWithData($companies);
    }
}
