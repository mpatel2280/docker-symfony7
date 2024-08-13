<?php
// src/EventListener/ProductCreatedListener.php

namespace App\EventListener;

use App\Event\ProductCreatedEvent;
use Psr\Log\LoggerInterface;

class ProductCreatedListener
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onProductCreated(ProductCreatedEvent $event)
    {
        $product = $event->getProduct();
        $this->logger->info('ProductCreatedListener :: Product created: ' . $product->getId());
    }
}
