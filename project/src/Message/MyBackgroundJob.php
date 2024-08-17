<?php
// src/Message/MyBackgroundJob.php
namespace App\Message;

class MyBackgroundJob
{
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getData(): string
    {
        return $this->data;
    }
}
