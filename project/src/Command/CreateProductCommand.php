<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;

#[AsCommand(
    name: 'app:create-product-command',
    description: 'Create new product via command',
    aliases: ['app:create-product', 'app:add-product']
)]
class CreateProductCommand extends Command
{
    protected static $defaultName = 'app:create-product-command';

    private $entityManager;
    private $productRepository;

    public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository)
    {
        $this->entityManager = $entityManager;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new product.')
            ->setHelp('This command allows you to create a product...')
            ->addArgument('name', InputArgument::REQUIRED, 'product name.')
            ->addArgument('price', InputArgument::REQUIRED, 'product price.')
            ->addArgument('description', InputArgument::REQUIRED, 'product description.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $price = $input->getArgument('price');
        $description = $input->getArgument('description');

        if ($name) {
            $io->note(sprintf('You passed an argument name : %s', $name));
        }

        if ($price) {
            $io->note(sprintf('You passed an argument price : %s', $price));
        }

        if ($description) {
            $io->note(sprintf('You passed an argument description: %s', $description));
        }

        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);
        
        // Save the record
        $this->productRepository->save($product);

       
        // $this->entityManager->persist($product);
        // $this->entityManager->flush();


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
