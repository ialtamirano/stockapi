<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;

use PDO;
use \RedBeanPHP\R as R;

class UserModel implements UserRepository
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
        $user = R::findAll('user');

        return R::exportAll($user);
    }

    public function findById($id)
    {

        $user = R::load('user', $id);

      
        if ( $user->id == 0)
        {
            throw new UserNotFoundExceptionUser();
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
            throw new UserNotFoundExceptionUser();
        }

        R::trash( $user);       
        return true;
    }



}