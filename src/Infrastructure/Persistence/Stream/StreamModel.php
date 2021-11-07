<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Stream;

use App\Domain\Stream\StreamNotFoundException;
use App\Domain\Stream\StreamRepository;

use PDO;
use \RedBeanPHP\R as R;

class StreamModel implements StreamRepository
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
        $streams = R::findAll('stream');

        return R::exportAll($streams);
    }

    public function findById($id)
    {

        $stream = R::load('stream', $id);

      
        if ( $stream->id == 0)
        {
            throw new StreamNotFoundException();
        }
        return $stream;
    }

    public function create($stream)
    {

        $bean = R::dispense('stream');

        $bean->import($stream);

        return $id = R::store($bean);
    }
    
    public function update($id, $stream)
    {

        $bean = R::load('stream', $id);

        $bean->import($stream);

        return $id = R::store($bean);
    }

    public function delete($id)
    {

        $stream = R::load('stream', $id);

        if ( $stream->id == 0)
        {
            throw new StreamNotFoundException();
        }

        R::trash( $stream);

      

        return true;
    }
}
