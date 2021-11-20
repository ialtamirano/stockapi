<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Customer;

use App\Domain\Customer\CustomerNotFoundException;
use App\Domain\Customer\CustomerRepository;

use PDO;
use \RedBeanPHP\R as R;

class CustomerModel implements CustomerRepository
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

    public function findById($id)
    {

        $customer = R::load('customer', $id);

      
        if ( $customer->id == 0)
        {
            throw new CustomerNotFoundException();
        }
        return $customer;
    }

    public function create($customer)
    {

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
}
