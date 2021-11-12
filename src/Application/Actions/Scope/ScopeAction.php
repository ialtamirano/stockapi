<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope;

use App\Application\Actions\Action;
use App\Domain\Scope\ScopeRepository;
use Psr\Log\LoggerInterface;

abstract class ScopeAction extends Action
{
    /**
     * @var ScopeRepository
     */
    protected $scopeRepository;

    /**
     * @param LoggerInterface $logger
     * @param ScopeRepository $scopeRepository
     */
    public function __construct(
        LoggerInterface $logger,
        ScopeRepository $scopeRepository
    ) {
        parent::__construct($logger);
        $this->scopeRepository = $scopeRepository;
    }
}
