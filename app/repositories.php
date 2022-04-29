<?php
declare(strict_types=1);




use App\Domain\Receipt\ReceiptRepository;
use App\Domain\Stream\StreamRepository;
use App\Domain\Account\AccountRepository;
use App\Domain\Scope\ScopeRepository;






use App\Infrastructure\Persistence\Receipt\ReceiptModel;

use App\Infrastructure\Persistence\Stream\StreamModel;

use App\Infrastructure\Persistence\Warehouse\WarehouseModel;
use App\Infrastructure\Persistence\Account\AccountModel;
use App\Infrastructure\Persistence\Scope\ScopeModel;




use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
   






    $containerBuilder->addDefinitions([
        ReceiptRepository::class => \DI\autowire(ReceiptModel::class),
    ]);

  

    $containerBuilder->addDefinitions([
        StreamRepository::class => \DI\autowire(StreamModel::class),
    ]);
  
    
    $containerBuilder->addDefinitions([
        AccountRepository::class => \DI\autowire(AccountModel::class),
    ]);
    $containerBuilder->addDefinitions([
        ScopeRepository::class => \DI\autowire(ScopeModel::class),
    ]);
 

   
};

