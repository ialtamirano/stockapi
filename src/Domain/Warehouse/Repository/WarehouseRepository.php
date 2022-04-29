<?php

namespace App\Domain\Warehouse\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class WarehouseRepository
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
        $warehouses = R::findAll('warehouse');

        return R::exportAll($warehouses);
    }

    public function search($query):array
    {
        
        $warehouses = R::find('warehouse', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($warehouses) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($warehouses);
    }

   

    public function findById($id)
    {

        $warehouse = R::load('warehouse', $id);

      
        if ( $warehouse->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $warehouse;
    }




    public function create($warehouse) {

        $bean = R::dispense('warehouse');

        $bean->import($warehouse);
        
        return $id = R::store($bean);
    }

    public function update($id, $warehouse)
    {

        $bean = R::load('warehouse', $id);

        $bean->import($warehouse);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $warehouse = R::load('warehouse', $id);

        if ( $warehouse->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $warehouse);

      

        return true;
    }




    public function findByCode($warehouseCode)
    {

        $warehouse = R::findOne('warehouse', 'code =  ? ', [
            $warehouseCode
        ]);

        if($warehouse){
            if ( $warehouse->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $warehouse;
    }


    
}