<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Warehouse;

use App\Domain\Warehouse\WarehouseNotFoundException;
use App\Domain\Warehouse\WarehouseRepository;

use PDO;
use \RedBeanPHP\R as R;

class WarehouseModel implements WarehouseRepository
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
        $warehouse = R::findAll('warehouse');

        return R::exportAll($warehouse);
    }

    public function findById($id)
    {

        $warehouse = R::load('warehouse', $id);

      
        if ( $warehouse->id == 0)
        {
            throw new WarehouseNotFoundException();
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
            throw new WarehouseNotFoundExceptionWarehouse();
        }

        R::trash( $warehouse);       
        return true;
    }



}