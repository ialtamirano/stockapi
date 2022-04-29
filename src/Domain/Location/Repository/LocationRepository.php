<?php

namespace App\Domain\Location\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class LocationRepository
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
        $locations = R::findAll('location');

        return R::exportAll($locations);
    }

    public function search($query):array
    {
        
        $locations = R::find('location', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($locations) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($locations);
    }

   

    public function findById($id)
    {

        $location = R::load('location', $id);

      
        if ( $location->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $location;
    }




    public function create($location) {

        $bean = R::dispense('location');

        $bean->import($location);
        
        return $id = R::store($bean);
    }

    public function update($id, $location)
    {

        $bean = R::load('location', $id);

        $bean->import($location);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $location = R::load('location', $id);

        if ( $location->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $location);

      

        return true;
    }




    public function findByCode($locationCode)
    {

        $location = R::findOne('location', 'code =  ? ', [
            $locationCode
        ]);

        if($location){
            if ( $location->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $location;
    }


    
}