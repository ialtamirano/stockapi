<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Client;

use App\Domain\Client\ClientNotFoundException;
use App\Domain\Client\ClientRepository;

use PDO;
use \RedBeanPHP\R as R;

class ClientModel implements ClientRepository
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
        $client = R::findAll('client');

        return R::exportAll($client);
    }

    public function findById($id)
    {

        $client = R::load('client', $id);

      
        if ( $client->id == 0)
        {
            throw new ClientNotFoundExceptionClient();
        }
        return $client;
    }

    public function create($client) {

        $bean = R::dispense('client');

        $bean->import($client);

        return $id = R::store($bean);
    }
    
    public function update($id, $client)
    {

        $bean = R::load('client', $id);

        $bean->import($client);

        return $id = R::store($bean);
    }

    public function delete($id)
    {

        $client = R::load('client', $id);

        if ( $client->id == 0)
        {
            throw new ClientNotFoundExceptionClient();
        }

        R::trash( $client);       
        return true;
    }



}