<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Location;

use App\Domain\Location\LocationNotFoundException;
use App\Domain\Location\LocationRepository;

use PDO;
use \RedBeanPHP\R as R;

class LocationModel implements LocationRepository
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

    public function findById($id)
    {

        $location = R::load('location', $id);

      
        if ( $location->id == 0)
        {
            throw new LocationNotFoundException();
        }
        return $location;
    }

    public function create($location)
    {

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
            throw new LocationNotFoundException();
        }

        R::trash( $location);

      

        return true;
    }
}
