<?php
namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;

class ProductService
{
    private $productRepository;
    private $logger;

    public function __construct(ProductRepository $productRepository, LoggerInterface $logger)
    {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    public function createProduct(string $name, float $price, string $description): void
    {
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);

        // Save the product using the repository's custom save method
        $this->productRepository->save($product);

        $this->logger->debug('Saved new product with id ', [
            'productId >>>>>>>>>>>>>>>> ' => $product->getId(),
        ]);
    }
}
