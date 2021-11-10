<?php
declare(strict_types=1);

use App\Domain\User\UserRepository;
use App\Domain\Client\ClientRepository;
use App\Domain\Company\CompanyRepository;
use App\Domain\Part\PartRepository;
use App\Domain\Inbox\InboxRepository;
use App\Domain\Receipt\ReceiptRepository;
use App\Domain\Location\LocationRepository;
use App\Domain\Stream\StreamRepository;
use App\Domain\Supplier\SupplierRepository;
use App\Domain\Warehouse\WarehouseRepository;
use App\Domain\Account\AccountRepository;

use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use App\Infrastructure\Persistence\Client\ClientModel;
use App\Infrastructure\Persistence\Company\CompanyModel;
use App\Infrastructure\Persistence\Part\PartModel;
use App\Infrastructure\Persistence\Inbox\InboxModel;
use App\Infrastructure\Persistence\Receipt\ReceiptModel;
use App\Infrastructure\Persistence\Location\LocationModel;
use App\Infrastructure\Persistence\Stream\StreamModel;
use App\Infrastructure\Persistence\Supplier\SupplierModel;
use App\Infrastructure\Persistence\Warehouse\WarehouseModel;
use App\Infrastructure\Persistence\Account\AccountModel;


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

    $containerBuilder->addDefinitions([
        InboxRepository::class => \DI\autowire(InboxModel::class),
    ]);

    $containerBuilder->addDefinitions([
        ReceiptRepository::class => \DI\autowire(ReceiptModel::class),
    ]);

    $containerBuilder->addDefinitions([
        LocationRepository::class => \DI\autowire(LocationModel::class),
    ]);

    $containerBuilder->addDefinitions([
        StreamRepository::class => \DI\autowire(StreamModel::class),
    ]);
    $containerBuilder->addDefinitions([
        SupplierRepository::class => \DI\autowire(SupplierModel::class),
    ]);
    $containerBuilder->addDefinitions([
        WarehouseRepository::class => \DI\autowire(WarehouseModel::class),
    ]);
    $containerBuilder->addDefinitions([
        AccountRepository::class => \DI\autowire(AccountModel::class),
    ]);
};

