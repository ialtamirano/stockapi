<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Client;


use App\Domain\Client\ClientNotFoundException;
use App\Domain\Client\ClientRepository;

use PDO;

class ClientModel implements ClientRepository
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

   /* public function insert(array $client){

        //2. query sql
        $sql = "INSERT INTO `clientes` (`id`, `codigo`, `nombre`, `rfc`, `celular`) 
        VALUES (NULL, :codigo, :nombre, :rfc, :celular);";

        //3. Asignar parametro a la consulta
        $params = [
            ":codigo" => $client['codigo'],
            ":nombre" => $client['nombre'],
            ":rfc" => $client['rfc'],
            ":celular" => $client['celular']
        ];

        $this->connection->prepare($sql)->execute($params);

  
        $id = (int) $this->connection->lastInsertId();

        //7. devuelves el valor
		return $id;
    }*/

    public function findAll():array{

       

        //2. query sql
        $sql = "SELECT * FROM clientes ";
        $params = [];

       //3. preparas el query
		$statement = $this->connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //4. Ejectutas
		 $statement->execute($params);

        //5. Lees el resultado
        $clientes = $statement->fetchAll(PDO::FETCH_OBJ);

        //6. devuelves el valor
		return $clientes;
    }

    public function findClientOfId($id)
    {

        //2. query sql
        $sql = "SELECT * FROM clientes WHERE id = :id ";

        //3. Asignar parametro a la consulta
        $params = [];
        $params[":id"] = $id;

       //4. preparas el query
		$statement = $this->connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //5. Ejectutas
		 $statement->execute($params);

        //6. Lees el resultado
        $client = $statement->fetch(PDO::FETCH_OBJ);

        if (!isset( $client->id)) {
            throw new ClientNotFoundException();
        }

        //7. devuelves el valor
		return $client;
    }

}