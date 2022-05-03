<?php

namespace App\Domain\Comment\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\User\Repository\UserRepository;


use PDO;
use \RedBeanPHP\R as R;
use \RedBeanPHP\Finder;
/**
 * Repository.
 */
final class CommentRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    private $userRepository;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection, UserRepository $userRepository)
    {
        $this->connection = $connection;
        $this->userRepository = $userRepository;
    }


    
    public function findAll($entity_name, $entity_id):array
    {
        
        $result = R::getAll('SELECT comment.*,user.full_name,user.email_address FROM comment
            INNER JOIN user ON user.id = comment.created_by
             WHERE entity_name = ? AND entity_id = ?', [ $entity_name, 
            $entity_id]);


            $comments = R::convertToBeans('comments', $result); 

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

        //$comment = R::load('comment', $id);


        $comment = R::getRow('SELECT comment.*, user.full_name,user.email_address FROM comment
            INNER JOIN user ON user.id = comment.created_by
             WHERE comment.id = ?', [ $id]);


        $comment = R::convertToBean('comment',$comment);

         if ( $comment->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        //$comment->user =  $this->userRepository->findById($comment->created_by);

        return $comment;
    }




    public function create($comment) {

        $bean = R::dispense('comment');

        $bean->import($comment);
        $id = R::store($bean);


        $comment = $this->findById($id);

        
        return $comment;
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