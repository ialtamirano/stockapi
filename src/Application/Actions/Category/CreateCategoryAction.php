<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

class CreateCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $category = $this->getFormData();
       
        $category->id = $this->categoryRepository->create($category);

        $this->logger->info("Category of id `$category->id` was created.");

        return $this->respondWithData($category);
    }
}
