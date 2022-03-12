<?php

namespace App\Domain\Authentication\Repository;

//use App\Domain\Authentication\AuthenticationNotFoundException;
//use App\Domain\Authentication\AuthenticationRepository;

use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class AuthenticationRegisterRepository
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

    public function register($user) {

        $bean = R::dispense('user');

        $bean->import($user);
        
        return $id = R::store($bean);
    }

    public function findByEmail($email)
    {

        $user = R::findOne('user', 'email_address =  ? ', [
            $email 
        ]);
        

      


        if($user){
            if ( $user->id == 0){
                    throw new AuthenticationNotFoundException();
                }
        
        }

        return $user;
    }
}