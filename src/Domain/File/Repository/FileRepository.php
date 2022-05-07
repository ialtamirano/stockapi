<?php

namespace App\Domain\File\Repository;

use App\Domain\DomainException\DomainRecordNotFoundException;


use PDO;
use \RedBeanPHP\R as R;
/**
 * Repository.
 */
final class FileRepository
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
        //$files = R::findAll('file');
        
       /* $files = R::findAll('file', 
           ' entity_name = ? AND entity_id = ? ', [
            $entity_name, 
            $entity_id
            
        ]);

        return R::exportAll($files);*/


        $result = R::getAll('SELECT file.*,user.full_name,user.email_address FROM file
            INNER JOIN user ON user.id = file.created_by
            WHERE entity_name = ? AND entity_id = ?', [ $entity_name, $entity_id]);


            $files = R::convertToBeans('files', $result); 

        return R::exportAll($files);


    }

    public function search($query):array
    {
        
        $files = R::find('file', 'code LIKE ? OR name LIKE ? OR description LIKE ? OR tags LIKE ?', [
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%',
            '%' . $query . '%'
        ]);

        if ( count($files) == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        return R::exportAll($files);
    }

   

    public function findById($id)
    {

        $file = R::load('file', $id);

      
        if ( $file->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }
        return $file;
    }




    public function create($file) {

        $bean = R::dispense('file');

        $bean->import($file);

        $id = R::store($bean);

        $file = $this->findById($id);
        
        return $file;
    }

    public function update($id, $file)
    {

        $bean = R::load('file', $id);

        $bean->import($file);

        return $id = R::store($bean);
    }


    public function delete($id)
    {

        $file = R::load('file', $id);

        if ( $file->id == 0)
        {
            throw new DomainRecordNotFoundException();
        }

        R::trash( $file);

      

        return true;
    }




    public function findByCode($fileCode)
    {

        $file = R::findOne('file', 'code =  ? ', [
            $fileCode
        ]);

        if($file){
            if ( $file->id == 0){
                throw new DomainRecordNotFoundException();
            }        
        }

        return $file;
    }


    
}