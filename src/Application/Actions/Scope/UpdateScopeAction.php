<?php
declare(strict_types=1);

namespace App\Application\Actions\Scope;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateScopeAction extends ScopeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $scopeId = (int) $this->resolveArg('id');
        $scope = $this->getFormData();
       
        $scope->id = $this->scopeRepository->update($scopeId,$scope);

        $this->logger->info("scope of id `$scope->id` was updated.");

        return $this->respondWithData($scope);
    }
}
