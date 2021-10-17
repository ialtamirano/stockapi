<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;


require 'models/ClientModel.php';
require 'models/ProductModel.php';

return function (App $app) {

    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response, array $args) {

  
       $renderer = new PhpRenderer('../public/templates');
       return $renderer->render($response, "home.html", $args);
        


      
    });

    //Clientes
    $app->group('/clientes', function (Group $group){

        $group->get('', function (Request $request, Response $response) {

            //1. instanciamos el modelo
            $clientModel = new ClientModel();
    
            //2. llamamos a la funcion para obtener clientes
            $clientData = $clientModel->getClientes();
    
            //3. convertimos a JSON
            $json = json_encode($clientData);
           
            $response->getBody()->write($json);
    
    
            return $response;
        });
    
        $group->get('/{id}', function (Request $request, Response $response,array $args) {
            
            //1. Obtener variables de la ruta
    
            $id = $args["id"];
    
            //2. instanciamos el modelo
            $clientModel = new ClientModel();
    
            //3. llamamos a la funcion para obtener clientes
            $clientData = $clientModel->getCliente($id);
    
            //4. convertimos a JSON
            $json = json_encode($clientData);
           
            //5. enviamos la respuesta
            $response->getBody()->write($json);
    
    
            return $response;
        });
    
        $group->post('', function (Request $request, Response $response) {
    
            //1. recibir la variable con los datos del json
            $body = $request->getParsedBody();
           
            //2. asignamos valores a los parametros
            $codigo = $body["codigo"];
            $nombre = $body["nombre"];
            $rfc = $body["rfc"];
            $celular = $body["celular"];
    
    
            //3. instanciamos el modelo
            $clientModel = new ClientModel();
    
            //4. llamamos a la funcion para crear clientes y obtenemos el Id
            $IdCliente = $clientModel->insertCliente($codigo,$nombre,$rfc,$celular);
    
    
            //5. Asignamos el Id al body
            $body["id"] = $IdCliente;
    
            //6. convertimos a JSON
            $json = json_encode($body);
           
            //7. responder=mos
            $response->getBody()->write($json);
    
    
            return $response;
        });
    
        $group->put('/{id}', function (Request $request, Response $response, array $args) {
    
            //1. recibir parametro de Id
            $id = $args["id"];
    
            //2. recibir la variable con los datos del json
            $body = $request->getParsedBody();
           
            //3. asignamos valores a los parametros
            $codigo = $body["codigo"];
            $nombre = $body["nombre"];
            $rfc = $body["rfc"];
            $celular = $body["celular"];
    
            //4. instanciamos el modelo
            $clientModel = new ClientModel();
    
            //5. llamamos a la funcion para crear clientes y obtenemos el Id
            $IdCliente = $clientModel->updateCliente($id,$codigo,$nombre,$rfc,$celular);
    
    
           
            //7. convertimos a JSON
            $json = json_encode($body);
           
            //8. responder=mos
            $response->getBody()->write($json);
    
    
            return $response;
        });
    
        $group->delete('/{id}', function (Request $request, Response $response,array $args) {
            
            //1. Obtener variables de la ruta
    
            $id = $args["id"];
    
            //2. instanciamos el modelo
            $clientModel = new ClientModel();
    
            //3. llamamos a la funcion para obtener clientes
            $resultado = $clientModel->deleteCliente($id);
    
            //4. convertimos a JSON
            $json = json_encode(array("resultado" => $resultado));
           
            //5. enviamos la respuesta
            $response->getBody()->write($json);
    
    
            return $response;
        });

    });

    //Productos
    $app->group('/productos', function(Group $group){

        $group->get('', function (Request $request, Response $response){

       

            $productModel = new ProductModel();

            $productos = $productModel->getProducts();

            $json = json_encode($productos);
           
            $response->getBody()->write($json);
    
    
            return $response;

        });

        $group->get('/{id}', function (Request $request, Response $response,array $args) {
            
            //1. Obtener variables de la ruta
    
            $id = $args["id"];
    
            //2. instanciamos el modelo
            $productModel = new ProductModel();
    
            //3. llamamos a la funcion para obtener clientes
            $product = $productModel->getProduct($id);
    
            //4. convertimos a JSON
            $json = json_encode($product);
           
            //5. enviamos la respuesta
            $response->getBody()->write($json);
    
    
            return $response;
        });

        $group->post('', function (Request $request, Response $response) {
    
            //1. recibir la variable con los datos del json
            $body = $request->getParsedBody();
           
        
    
    
            //3. instanciamos el modelo
            $productModel = new ProductModel();
    
            //4. llamamos a la funcion para crear clientes y obtenemos el Id
            $IdProduct= $productModel->insertProduct($body);
    
    
            //5. Asignamos el Id al body
            $body["id"] = $IdProduct;
    
            //6. convertimos a JSON
            $json = json_encode($body);
           
            //7. responder=mos
            $response->getBody()->write($json);
    
    
            return $response;
        });

        $group->put('/{id}', function (Request $request, Response $response, array $args) {
    
            //1. recibir parametro de Id
            $id = $args["id"];
    
            //2. recibir la variable con los datos del json
            $body = $request->getParsedBody();
           
        
    
            //4. instanciamos el modelo
            $productModel = new ProductModel();
    
            //5. llamamos a la funcion para crear clientes y obtenemos el Id
            $IdProducto = $productModel->updateProduct($id,$body);
    

            //7. convertimos a JSON
            $json = json_encode($body);
           
            //8. responder=mos
            $response->getBody()->write($json);
    
    
            return $response;
        });

        $group->delete('/{id}', function (Request $request, Response $response,array $args) {
            
            //1. Obtener variables de la ruta
    
            $id = $args["id"];
    
            //2. instanciamos el modelo
            $productModel = new ProductModel();
    
            //3. llamamos a la funcion para obtener clientes
            $resultado = $productModel->deleteProduct($id);
    
            //4. convertimos a JSON
            $json = json_encode(array("resultado" => $resultado));
           
            //5. enviamos la respuesta
            $response->getBody()->write($json);
    
    
            return $response;
        });


    });
    
    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
