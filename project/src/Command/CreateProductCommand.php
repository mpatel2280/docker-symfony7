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
use App\Service\ProductService;

#[AsCommand(
    name: 'app:create-product-command',
    description: 'Create new product via command',
    aliases: ['app:create-product', 'app:add-product']
)]
class CreateProductCommand extends Command
{
    protected static $defaultName = 'app:create-product-command';

    private $entityManager;
    private $productService;

    public function __construct(EntityManagerInterface $entityManager, ProductService $productService)
    {
        $this->entityManager = $entityManager;
        $this->productService = $productService;
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
        
        // Save the record
        $this->productService->createProduct($name, $price, $description);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
