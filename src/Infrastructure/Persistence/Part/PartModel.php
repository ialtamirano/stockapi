<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Part;


use App\Domain\Part\PartNotFoundException;
use App\Domain\Part\PartRepository;

use PDO;
use \RedBeanPHP\R as R;

class PartModel implements PartRepository
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

  

    public function findAll():array{

        $parts = R::findAll('part');

        return R::exportAll($parts);;

       
    }

    public function findById($id)
    {

        $part = R::load( 'part', $id );

      
        if ( $part->id == 0) {
            throw new PartNotFoundException();
        }



        return $part;
    }

    public function create($part){

        $bean = R::dispense('part');

        $bean->import($part);

        return $id = R::store($bean);

    }
    
    public function update($id, $part){

        $bean = R::load( 'part', $id );

        $bean->import($part);

        return $id = R::store($bean);
    }

}