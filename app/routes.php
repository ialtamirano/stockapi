<?php
declare(strict_types=1);



use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsertAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\UpdateUserAction;
use App\Application\Actions\User\DeleteUserAction;

use App\Application\Actions\Clientt\ViewClientAction;
use App\Application\Actions\Client\ListClientAction;
use App\Application\Actions\Client\CreateClientAction;
use App\Application\Actions\Client\UpdateClientAction;
use App\Application\Actions\Client\DeleteClientAction;

use App\Application\Actions\Company\ViewCompanyAction;
use App\Application\Actions\Company\ListCompanyAction;
use App\Application\Actions\Company\CreateCompanyAction;
use App\Application\Actions\Company\UpdateCompanyAction;

use App\Application\Actions\Part\ViewPartAction;
use App\Application\Actions\Part\ListPartAction;
use App\Application\Actions\Part\CreatePartAction;
use App\Application\Actions\Part\UpdatePartAction;

use App\Application\Actions\Inbox\ViewInboxAction;
use App\Application\Actions\Inbox\ListInboxAction;
use App\Application\Actions\Inbox\CreateInboxAction;
use App\Application\Actions\Inbox\UpdateInboxAction;


use App\Application\Actions\Receipt\ViewReceiptAction;
use App\Application\Actions\Receipt\ListReceiptAction;
use App\Application\Actions\Receipt\CreateReceiptAction;
use App\Application\Actions\Receipt\UpdateReceiptAction;


use App\Application\Actions\Location\ViewLocationAction;
use App\Application\Actions\Location\ListLocationAction;
use App\Application\Actions\Location\CreateLocationAction;
use App\Application\Actions\Location\UpdateLocationAction;
use App\Application\Actions\Location\DeleteLocationAction;

use App\Application\Actions\Stream\ViewStreamAction;
use App\Application\Actions\Stream\ListStreamAction;
use App\Application\Actions\Stream\CreateStreamAction;
use App\Application\Actions\Stream\UpdateStreamAction;
use App\Application\Actions\Stream\DeleteStreamAction;


use App\Application\Actions\Supplier\ViewSupplierAction;
use App\Application\Actions\Supplier\ListSupplierAction;
use App\Application\Actions\Supplier\CreateSupplierAction;
use App\Application\Actions\Supplier\UpdateSupplierAction;
use App\Application\Actions\Supplier\DeleteSupplierAction;


use App\Application\Actions\Warehouse\ViewWarehouseAction;
use App\Application\Actions\Warehouse\ListWarehouseAction;
use App\Application\Actions\Warehouse\CreateWarehouseAction;
use App\Application\Actions\Warehouse\UpdateWarehouseAction;
use App\Application\Actions\Warehouse\DeleteWarehouseAction;

use App\Application\Actions\Account\ViewAccountAction;
use App\Application\Actions\Account\ListAccountAction;
use App\Application\Actions\Account\CreateAccountAction;
use App\Application\Actions\Account\UpdateAccountAction;
use App\Application\Actions\Account\DeleteAccountAction;


use App\Application\Actions\Scope\ViewScopeAction;
use App\Application\Actions\Scope\ListScopeAction;
use App\Application\Actions\Scope\CreateScopeAction;
use App\Application\Actions\Scope\UpdateScopeAction;
use App\Application\Actions\Scope\DeleteScopeAction;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Slim\Views\PhpRenderer;

use Slim\Exception\HttpNotFoundException;


return function (App $app) {

   

    $app->options('/{routes:.+}', function (Request $request, Response $response) {
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
    

    $app->group('/clients', function (Group $group){

        $group->get('/',ListClientAction::class);
        $group->get('/{id}',ViewClientAction::class);
        $group->post('/',CreateClientAction::class);
        $group->put('/{id}',UpdateClientAction::class);
        $group->delete('/{id}',DeleteClientAction::class);
    });
     
   
    

    $app->group('/companies', function (Group $group){

        $group->get('/',ListCompanyAction::class);
        $group->get('/{id}',ViewCompanyAction::class);
        $group->post('',CreateCompanyAction::class);
        $group->put('/{id}',UpdateCompanyAction::class);
   
    });

    $app->group('/parts', function (Group $group){

        $group->get('/',ListPartAction::class);
        $group->get('/{id}',ViewPartAction::class);
        $group->post('',CreatePartAction::class);
        $group->put('/{id}',UpdatePartAction::class);
   
    });

    $app->group('/inbox', function (Group $group){

        $group->get('/',ListInboxAction::class);
        $group->get('/{id}',ViewInboxAction::class);
        $group->post('',CreateInboxAction::class);
        $group->put('/{id}',UpdateInboxAction::class);
   
    });

    $app->group('/receipts', function (Group $group){

        $group->get('/',ListReceiptAction::class);
        $group->get('/{id}',ViewReceiptAction::class);
        $group->post('',CreateReceiptAction::class);
        $group->put('/{id}',UpdateReceiptAction::class);
   
    });

    $app->group('/locations', function (Group $group){

        $group->get('/',ListLocationAction::class);
        $group->get('/{id}',ViewLocationAction::class);
        $group->post('/',CreateLocationAction::class);
        
        $group->put('/{id}',UpdateLocationAction::class);
        $group->delete('/{id}',DeleteLocationAction::class);
   
    });

    /*$app->options('/locations', function (Request $request, Response $response): Response {
        return $response;
    });*/


    $app->group('/streams', function (Group $group){

        $group->get('/',ListStreamAction::class);
        $group->get('/{id}',ViewStreamAction::class);
        $group->post('/',CreateStreamAction::class);
        $group->put('/{id}',UpdateStreamAction::class);
        $group->delete('/{id}',DeleteStreamAction::class);
   
    });
    $app->group('/suppliers', function (Group $group){

        $group->get('/',ListSupplierAction::class);
        $group->get('/{id}',ViewSupplierAction::class);
        $group->post('/',CreateSupplierAction::class);
        $group->put('/{id}',UpdateSupplierAction::class);
        $group->delete('/{id}',DeleteSupplierAction::class);
   
    });
    $app->group('/warehouses', function (Group $group){

        $group->get('/',ListWarehouseAction::class);
        $group->get('/{id}',ViewWarehouseAction::class);
        $group->post('/',CreateWarehouseAction::class);
        $group->put('/{id}',UpdateWarehouseAction::class);
        $group->delete('/{id}',DeleteWarehouseAction::class);
   
    });
    $app->group('/accounts', function (Group $group){

        $group->get('/',ListAccountAction::class);
        $group->get('/{id}',ViewAccountAction::class);
        $group->post('/',CreateAccountAction::class);
        $group->put('/{id}',UpdateAccountAction::class);
        $group->delete('/{id}',DeleteAccountAction::class);
   
    });

    $app->group('/scopes', function (Group $group){

        $group->get('/',ListScopeAction::class);
        $group->get('/{id}',ViewScopeAction::class);
        $group->post('/',CreateScopeAction::class);
        $group->put('/{id}',UpdateScopeAction::class);
        $group->delete('/{id}',DeleteScopeAction::class);
    });

    $app->group('/users', function (Group $group){

        $group->get('/',ListUserAction::class);
        $group->get('/{id}',ViewUserAction::class);
        $group->post('/',CreateUserAction::class);
        $group->put('/{id}',UpdateUserAction::class);
        $group->delete('/{id}',DeleteUserAction::class);
    });


    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new HttpNotFoundException($request);
    });
    
   
};
