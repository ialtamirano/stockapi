<?php
declare(strict_types=1);






use App\Domain\Account\AccountRepository;










use App\Infrastructure\Persistence\Account\AccountModel;





use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
   



  
    
    $containerBuilder->addDefinitions([
        AccountRepository::class => \DI\autowire(AccountModel::class),
    ]);

 

   
};

