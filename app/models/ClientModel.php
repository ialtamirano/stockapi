<?php

class ClientModel {

    public $pdo_connection = null;

    public function __construct(){
       
         //1. Conexion
         $this->pdo_connection = new PDO("mysql:host=localhost;dbname=stockdb;", "root", "");
         $this->pdo_connection->exec("SET CHARACTER SET utf8");
         $this->pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
    }

    public function getClientes(){

       


        //2. query sql
        $sql = "SELECT * FROM clientes ";
        $params = [];

       //3. preparas el query
		$statement = $this->pdo_connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //4. Ejectutas
		 $statement->execute($params);

        //5. Lees el resultado
        $clientes = $statement->fetchAll(PDO::FETCH_OBJ);

        //6. devuelves el valor
		return $clientes;
    }

    public function getCliente($Id){


       

        //2. query sql
        $sql = "SELECT * FROM `clientes` WHERE `id` = :Id ";

        //3. Asignar parametro a la consulta
        $params = [];
        $params[":Id"] = $Id;

       //4. preparas el query
		$statement = $this->pdo_connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //5. Ejectutas
		 $statement->execute($params);

        //6. Lees el resultado
        $clientes = $statement->fetch(PDO::FETCH_OBJ);

        //7. devuelves el valor
		return $clientes;
    }

    public function insertCliente($codigo,$nombre,$rfc,$celular){


   
        //2. query sql
        $sql = "INSERT INTO `clientes` (`id`, `codigo`, `nombre`, `rfc`, `celular`) 
        VALUES (NULL, :codigo, :nombre, :rfc, :celular);";

        //3. Asignar parametro a la consulta
        $params = [];
        $params[":codigo"] = $codigo;
        $params[":nombre"] = $nombre;
        $params[":rfc"] = $rfc;
        $params[":celular"] = $celular;

       //4. preparas el query
		$statement = $this->pdo_connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //5. Ejectutas
		 $statement->execute($params);

        //6. Lees el ultimo Id Insertado
  
        $id = (int) $this->pdo_connection->lastInsertId();

        //7. devuelves el valor
		return $id;
    }

    public function updateCliente($id,$codigo,$nombre,$rfc,$celular){




        //2. query sql
        $sql = "UPDATE `clientes` SET `codigo` =  :codigo,`nombre` =  :nombre, 
        `rfc` =  :rfc,`celular` =  :celular  WHERE `id` = :id;";

        //3. Asignar parametro a la consulta
        $params = [];
        $params[":id"] = $id;
        $params[":codigo"] = $codigo;
        $params[":nombre"] = $nombre;
        $params[":rfc"] = $rfc;
        $params[":celular"] = $celular;

       //4. preparas el query
		$statement = $pdo_connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //5. Ejectutas
		return $statement->execute($params);

      
    }

    public function deleteCliente($id){



        //2. query sql
        $sql = "DELETE FROM `clientes` WHERE `id` = :id;";

        //3. Asignar parametro a la consulta
        $params = [];
        $params[":id"] = $id;
       

       //4. preparas el query
		$statement = $pdo_connection->prepare($sql);
		$statement->setFetchMode(PDO::FETCH_OBJ);

        //5. Ejectutas
		return $statement->execute($params);

      
    }

}