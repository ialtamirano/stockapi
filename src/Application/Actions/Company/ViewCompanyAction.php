<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use Psr\Http\Message\ResponseInterface as Response;

class ViewCompanyAction extends CompanyAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $companyId = (int) $this->resolveArg('id');
        $company = $this->companyRepository->findById($companyId);

        $this->logger->info("Company of id `${companyId}` was viewed.");

        return $this->respondWithData($company);
    }
}
