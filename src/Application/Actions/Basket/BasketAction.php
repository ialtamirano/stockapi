<?php
declare(strict_types=1);

namespace App\Application\Actions\Basket;

use App\Application\Actions\Action;
use App\Domain\Basket\BasketRepository;
use Psr\Log\LoggerInterface;

abstract class BasketAction extends Action
{
    /**
     * @var BasketRepository
     */
    protected $basketRepository;

    /**
     * @param LoggerInterface $logger
     * @param BasketRepository $basketRepository
     */
    public function __construct(
        LoggerInterface $logger,
        BasketRepository $basketRepository
    ) {
        parent::__construct($logger);
        $this->basketRepository = $basketRepository;
    }
}
