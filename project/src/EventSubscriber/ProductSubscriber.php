<?php
// src/EventSubscriber/ProductSubscriber.php

namespace App\EventSubscriber;

use App\Event\ProductCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            ProductCreatedEvent::NAME => 'onProductCreated',
        ];
    }

    public function onProductCreated(ProductCreatedEvent $event)
    {
        $product = $event->getProduct();
        $this->logger->info('ProductSubscriber :: Product Created: ' . $product->getId());
    }
}
