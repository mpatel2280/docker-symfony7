<?php

// src/Service/HelperService.php

namespace App\Service;

class HelperService
{
    public function formatDate(\DateTime $date, string $format = 'Y-m-d'): string
    {
        return $date->format($format);
    }

    public function generateSlug(string $string): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
    }
}
