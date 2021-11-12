<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope;

use Psr\Http\Message\ResponseInterface as Response;

class CreateScopeAction extends ScopeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $Scope = $this->getFormData();
       
        $Scope->id = $this->scopeRepository->create($Scope);

        $this->logger->info("Scope of id `$Scope->id` was created.");

        return $this->respondWithData($Scope);
    }
}
