<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
use App\Service\HelperService;


use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    // #[Route('/product', name: 'app_product')]
    // public function index(): Response
    // {
    //     return $this->render('product/index.html.twig', [
    //         'controller_name' => 'ProductController',
    //     ]);
    // }

    private $helperService;

    public function __construct(HelperService $helperService)
    {
        $this->helperService = $helperService;
    }

    #[Route('/product', name: 'create_product')]
    public function createProduct(EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        $product = new Product();
        $product->setName('Keypad');
        $price = random_int(0, 10000);
        $product->setPrice($price);
        $product->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $logger->debug('Saved new product with id ', [
            'productId >>>>>>>>>>>>>>>> ' => $product->getId(),
        ]);

        return new Response('Saved new product with id '.$product->getId());
    }

    #[Route('/product/{id}', name: 'product_show')]
    public function show(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $appSecret = $_SERVER['APP_SECRET']; // $this->getParameter('app.secret');

        $date = new \DateTime();
        $formattedDate = $this->helperService->formatDate($date);
        
        return new Response('Check out this great product: '.$product->getName() . ' at ' . $product->getPrice() . ' appSecret test : ' . $appSecret . ' Helper test : ' . $formattedDate.time());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
