<?php

require __DIR__ . '/vendor/autoload.php';
print_r($_ENV);
die;
// (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/../.env');

include __DIR__ . '/routes/pages.php';

use App\Controller\Http\Router;

Router::run();
