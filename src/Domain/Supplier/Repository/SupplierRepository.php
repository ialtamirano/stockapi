<?php

namespace App\Domain\Supplier\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class SupplierRepository
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
        $suppliers = R::findAll('supplier');

        return R::exportAll($suppliers);
    }

    public function search($query):array
    {
        
        $suppliers = R::find('supplier', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($suppliers) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($suppliers);
    }

   

    public function findById($id)
    {

        $supplier = R::load('supplier', $id);

      
        if ( $supplier->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $supplier;
    }




    public function create($supplier) {

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
            throw new DomainRecordNotFoundException();
        }

        R::trash( $supplier);

      

        return true;
    }




    public function findByCode($supplierCode)
    {

        $supplier = R::findOne('supplier', 'code =  ? ', [
            $supplierCode
        ]);

        if($supplier){
            if ( $supplier->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $supplier;
    }


    
}