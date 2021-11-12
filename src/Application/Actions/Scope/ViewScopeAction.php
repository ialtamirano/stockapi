<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope; 
//purebaaa

use Psr\Http\Message\ResponseInterface as Response;

class ViewScopeAction extends ScopeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $scopeId = (int) $this->resolveArg('id');
        $scope = $this->scopeRepository->findById($scopeId);

        $this->logger->info("scope of id `${scopeId}` was viewed.");

        return $this->respondWithData($scope);
    }
}
