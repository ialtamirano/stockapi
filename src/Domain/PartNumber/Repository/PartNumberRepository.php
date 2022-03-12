<?php

namespace App\Domain\PartNumber\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class PartNumberRepository
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
        $parts = R::findAll('part');

        return R::exportAll($parts);
    }

    public function search($query):array
    {
        
        $parts = R::find('part', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($parts) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($parts);
    }

   

    public function findById($id)
    {

        $part = R::load('part', $id);

      
        if ( $part->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $part;
    }




    public function create($part) {

        $bean = R::dispense('part');

        $bean->import($part);
        
        return $id = R::store($bean);
    }

    public function update($id, $part)
    {

        $bean = R::load('part', $id);

        $bean->import($part);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $part = R::load('part', $id);

        if ( $part->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $part);

      

        return true;
    }




    public function findByCode($partNumberCode)
    {

        $part = R::findOne('part', 'code =  ? ', [
            $partNumberCode
        ]);

        if($part){
            if ( $part->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $part;
    }


    
}