<?php

namespace App\Domain\Stream\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class StreamRepository
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

    public function search($query):array
    {
        
        $streams = R::find('stream', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($streams) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($streams);
    }

   

    public function findById($id)
    {

        $stream = R::load('stream', $id);

      
        if ( $stream->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $stream;
    }




    public function create($stream) {

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
            throw new DomainRecordNotFoundException();
        }

        R::trash( $stream);

      

        return true;
    }




    public function findByCode($streamCode)
    {

        $stream = R::findOne('stream', 'code =  ? ', [
            $streamCode
        ]);

        if($stream){
            if ( $stream->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $stream;
    }


    
}