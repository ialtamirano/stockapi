<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Inbox;

use App\Domain\Inbox\InboxNotFoundException;
use App\Domain\Inbox\InboxRepository;

use PDO;
use \RedBeanPHP\R as R;

class InboxModel implements InboxRepository
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
        $inboxs = R::findAll('inbox');

        return R::exportAll($inboxs);
    }

    public function findById($id)
    {

        $inbox = R::load('inbox', $id);

      
        if ( $inbox->id == 0)
        {
            throw new InboxNotFoundException();
        }
        return $inbox;
    }

    public function create($inbox)
    {

        $bean = R::dispense('inbox');

        $bean->import($inbox);

        return $id = R::store($bean);
    }
    
    public function update($id, $inbox)
    {

        $bean = R::load('inbox', $id);

        $bean->import($inbox);

        return $id = R::store($bean);
    }
}
