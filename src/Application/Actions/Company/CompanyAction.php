<?php
declare(strict_types=1);

namespace App\Application\Actions\Company;

use App\Application\Actions\Action;
use App\Domain\Company\CompanyRepository;
use Psr\Log\LoggerInterface;

abstract class CompanyAction extends Action
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @param LoggerInterface $logger
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        LoggerInterface $logger,
        CompanyRepository $companyRepository
    ) {
        parent::__construct($logger);
        $this->companyRepository = $companyRepository;
    }
}
