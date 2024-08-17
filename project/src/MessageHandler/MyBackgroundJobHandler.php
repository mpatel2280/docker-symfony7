<?php
// src/MessageHandler/MyBackgroundJobHandler.php
namespace App\MessageHandler;

use App\Message\MyBackgroundJob;
# use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MyBackgroundJobHandler
{
    public function __invoke(MyBackgroundJob $message)
    {
        // Perform the background task (e.g., sending an email, processing a file, etc.)
        $data = $message->getData();
        // ... do some work with $data ...
        
        // Simulating some work
        sleep(5);
        
        // Log or do something with the result
        echo "Background job processed: " . $data . "\n";
    }
}
