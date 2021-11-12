<?php
declare(strict_types=1);

namespace App\Application\Actions\scope;

use Psr\Http\Message\ResponseInterface as Response;

class ListScopeAction extends ScopeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $scope = $this->ScopeRepository->findAll();

        $this->logger->info("scope list was viewed.");

        return $this->respondWithData($scope);
    }
}
