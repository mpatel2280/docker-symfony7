<?php
// src/Controller/JobController.php
namespace App\Controller;

use App\Message\MyBackgroundJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    #[Route('/start-job', name: 'start_job')]
    public function startJob(MessageBusInterface $bus): Response
    {
        // Dispatch the message to the async transport
        $bus->dispatch(new MyBackgroundJob('Sample Data for Background Job'));

        return new Response('Background job started!');
    }
}
