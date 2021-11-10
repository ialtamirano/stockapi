<?php
declare(strict_types=1);

namespace Tests\Application\Actions\Location;

use App\Application\Actions\ActionPayload;
use App\Domain\Location\LocationRepository;
//use App\Domain\Location\Location;
use DI\Container;
use Tests\TestCase;

class ListLocationActionTest extends TestCase
{
    public function testAction()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $location = json_encode(array ( 'id'=> 17, 'code' => 'REC', 'name' => 'REcibos 2'));

        

        $locationRepositoryProphecy = $this->prophesize(LocationRepository::class);
        $locationRepositoryProphecy
            ->findAll()
            ->willReturn([$location])
            ->shouldBeCalledOnce();

        $container->set(LocationRepository::class, $locationRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/locations/');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
       

        $expectedPayload = new ActionPayload(200, [$location]);
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
