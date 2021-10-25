<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use Psr\Http\Message\ResponseInterface as Response;

class CreateCompanyAction extends CompanyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $company = $this->getFormData();
       
        $company->id = $this->companyRepository->create($company);

        $this->logger->info("Company of id `$company->id` was created.");

        return $this->respondWithData($company);
    }
}
