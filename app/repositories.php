<?php
declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Domain\Client\ClientRepository;
use App\Domain\Company\CompanyRepository;
use App\Domain\Part\PartRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Client\ClientModel;
use App\Infrastructure\Persistence\Company\CompanyModel;
use App\Infrastructure\Persistence\Part\PartModel;


use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
    ]);

    $containerBuilder->addDefinitions([
        ClientRepository::class => \DI\autowire(ClientModel::class),
    ]);

    $containerBuilder->addDefinitions([
        CompanyRepository::class => \DI\autowire(CompanyModel::class),
    ]);

    $containerBuilder->addDefinitions([
        PartRepository::class => \DI\autowire(PartModel::class),
    ]);
};
