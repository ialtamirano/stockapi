<?php

namespace App\Domain\User\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class UserRepository
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
        $users = R::findAll('user');

        return R::exportAll($users);
    }

    public function search($query):array
    {
        
        $users = R::find('user', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($users) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($users);
    }

   

    public function findById($id)
    {

        $user = R::load('user', $id);

      
        if ( $user->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $user;
    }




    public function create($user) {

        $bean = R::dispense('user');

        $bean->import($user);
        
        return $id = R::store($bean);
    }

    public function update($id, $user)
    {

        $bean = R::load('user', $id);

        $bean->import($user);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $user = R::load('user', $id);

        if ( $user->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $user);

      

        return true;
    }




    public function findByCode($userCode)
    {

        $user = R::findOne('user', 'code =  ? ', [
            $userCode
        ]);

        if($user){
            if ( $user->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $user;
    }

    public function findByEmail($userEmail)
    {

        $user = R::findOne('user', 'email_address =  ? ', [
            $userEmail
        ]);

        if($user){
            if ( $user->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $user;
    }


    
}