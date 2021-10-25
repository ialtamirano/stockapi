<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateCompanyAction extends CompanyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $companyId = (int) $this->resolveArg('id');
        $company = $this->getFormData();
       
        $company->id = $this->companyRepository->update($companyId, $company);

        $this->logger->info("Company of id `$company->id` was updated.");

        return $this->respondWithData($company);
    }
}