<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Supplier;

use App\Domain\Supplier\SupplierNotFoundException;
use App\Domain\Supplier\SupplierRepository;

use PDO;
use \RedBeanPHP\R as R;

class SupplierModel implements SupplierRepository
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
        $supplier = R::findAll('supplier');

        return R::exportAll($supplier);
    }

    public function findById($id)
    {

        $supplier = R::load('supplier', $id);

      
        if ( $supplier->id == 0)
        {
            throw new SupplierNotFoundException();
        }
        return $supplier;
    }

    public function create($supplier)
    {

        $bean = R::dispense('supplier');

        $bean->import($supplier);

        return $id = R::store($bean);
    }
    
    public function update($id, $supplier)
    {

        $bean = R::load('supplier', $id);

        $bean->import($supplier);

        return $id = R::store($bean);
    }

    public function delete($id)
    {

        $supplier = R::load('supplier', $id);

        if ( $supplier->id == 0)
        {
            throw new SupplierNotFoundException();
        }

        R::trash( $supplier);

      

        return true;
    }
}
