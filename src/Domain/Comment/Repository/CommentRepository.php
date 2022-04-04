<?php

namespace App\Domain\Comment\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class CommentRepository
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


    
    public function findAll($entity_name, $entity_id):array
    {
        //$comments = R::findAll('comment');
        
        $comments = R::findAll('comment', 
           ' entity_name = ? AND entity_id = ? ', [
            $entity_name, 
            $entity_id
            
        ]);

        return R::exportAll($comments);
    }

    public function search($query):array
    {
        
        $comments = R::find('comment', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($comments) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($comments);
    }

   

    public function findById($id)
    {

        $comment = R::load('comment', $id);

      
        if ( $comment->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $comment;
    }




    public function create($comment) {

        $bean = R::dispense('comment');

        $bean->import($comment);
        
        return $id = R::store($bean);
    }

    public function update($id, $comment)
    {

        $bean = R::load('comment', $id);

        $bean->import($comment);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $comment = R::load('comment', $id);

        if ( $comment->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $comment);

      

        return true;
    }




    public function findByCode($commentCode)
    {

        $comment = R::findOne('comment', 'code =  ? ', [
            $commentCode
        ]);

        if($comment){
            if ( $comment->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $comment;
    }


    
}