<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Category;

use App\Domain\Category\CategoryNotFoundException;
use App\Domain\Category\CategoryRepository;

use PDO;
use \RedBeanPHP\R as R;

class CategoryModel implements CategoryRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function findAll():array
    {
        $categorys = R::findAll('category');

        return R::exportAll($categorys);
    }

    public function findById($id)
    {

        $category = R::load('category', $id);

      
        if ( $category->id == 0)
        {
            throw new CategoryNotFoundException();
        }
        return $category;
    }

    public function create($category)
    {

        $bean = R::dispense('category');

        $bean->import($category);

        return $id = R::store($bean);
    }
    
    public function update($id, $category)
    {

        $bean = R::load('category', $id);

        $bean->import($category);

        return $id = R::store($bean);
    }
}
