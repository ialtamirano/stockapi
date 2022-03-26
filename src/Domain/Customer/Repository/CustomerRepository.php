<?php

namespace App\Domain\Customer\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class CustomerRepository
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
        $customers = R::findAll('customer');

        return R::exportAll($customers);
    }

    public function search($query):array
    {
        
        $customers = R::find('customer', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($customers) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($customers);
    }

   

    public function findById($id)
    {

        $customer = R::load('customer', $id);

      
        if ( $customer->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $customer;
    }




    public function create($customer) {

        $bean = R::dispense('customer');

        $bean->import($customer);
        
        return $id = R::store($bean);
    }

    public function update($id, $customer)
    {

        $bean = R::load('customer', $id);

        $bean->import($customer);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $customer = R::load('customer', $id);

        if ( $customer->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $customer);

      

        return true;
    }




    public function findByCode($customerCode)
    {

        $customer = R::findOne('customer', 'code =  ? ', [
            $customerCode
        ]);

        if($customer){
            if ( $customer->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $customer;
    }


    
}