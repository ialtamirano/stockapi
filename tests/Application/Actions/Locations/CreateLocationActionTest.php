<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Location;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Application\Handlers\HttpErrorHandler;
use App\Domain\Location\LocationNotFoundException;
use App\Domain\Location\LocationRepository;
use DI\Container;
use Slim\Middleware\ErrorMiddleware;
use Tests\TestCase;

class CreateLocationActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        
        $location = [  
            'code' => 'Prueba Nuevo', 
            'name' => 'Prueba Nuevo' , 
            'warehouse_id'=> '1',
             'deleted' =>'0'
        ];

        $id = null;
        $newLocation = null;

        $locationRepositoryProphecy = $this->prophesize(LocationRepository::class);
        $locationRepositoryProphecy
            ->create($location)
            ->willReturn($newLocation)
            ->shouldBeCalledOnce();

        $container->set(LocationRepository::class, $locationRepositoryProphecy->reveal());

        
        $request = $this->createRequest('POST', '/locations/');
        //$object = json_decode(json_encode($location));
        $request = $request->withParsedBody($location);
        //var_dump($object);
        //exit;
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        
        $expectedPayload = new ActionPayload(200, $newLocation);
        
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    /*public function testActionThrowsLocationNotFoundException()
    {
        $app = $this->getAppInstance();

        $callableResolver = $app->getCallableResolver();
        $responseFactory = $app->getResponseFactory();

        $errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);
        $errorMiddleware = new ErrorMiddleware($callableResolver, $responseFactory, true, false, false);
        $errorMiddleware->setDefaultErrorHandler($errorHandler);

        $app->add($errorMiddleware);

   
        $container = $app->getContainer();

        $locationRepositoryProphecy = $this->prophesize(LocationRepository::class);
        $locationRepositoryProphecy
            ->findById(1)
            ->willThrow(new LocationNotFoundException())
            ->shouldBeCalledOnce();

        $container->set(LocationRepository::class, $locationRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/locations/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedError = new ActionError(ActionError::RESOURCE_NOT_FOUND, 'The Location you requested does not exist.....');
        $expectedPayload = new ActionPayload(404, null, $expectedError);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }*/
}
