<?php
declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateCategoryAction extends CategoryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

        $categoryId = (int) $this->resolveArg('id');
        $category = $this->getFormData();
       
        $category->id = $this->categoryRepository->update($categoryId,$category);

        $this->logger->info("Category of id `$category->id` was updated.");

        return $this->respondWithData($category);
    }
}
