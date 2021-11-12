<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteScopeAction extends ScopeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $ScopeId = (int) $this->resolveArg('id');
        $Scope = $this->scopeRepository->delete($ScopeId);

        $this->logger->info("Scope of id `${ScopeId}` was deleted.");

        return $this->respondWithData($Scope);
    }
}
