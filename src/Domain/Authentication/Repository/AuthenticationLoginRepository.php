<?php

namespace App\Domain\Authentication\Repository;

use App\Domain\Authentication\AuthenticationNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class AuthenticationLoginRepository
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