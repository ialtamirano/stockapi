<?php

namespace App\Domain\Category\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class CategoryRepository
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

    public function search($query):array
    {
        
        $categorys = R::find('category', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($categorys) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($categorys);
    }

   

    public function findById($id)
    {

        $category = R::load('category', $id);

      
        if ( $category->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $category;
    }




    public function create($category) {

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


    public function delete($id)
    {

        $category = R::load('category', $id);

        if ( $category->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $category);

      

        return true;
    }




    public function findByCode($categoryCode)
    {

        $category = R::findOne('category', 'code =  ? ', [
            $categoryCode
        ]);

        if($category){
            if ( $category->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $category;
    }


    
}