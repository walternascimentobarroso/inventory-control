<?php

require __DIR__ . '/vendor/autoload.php';
echo ("<pre>");
print_r($_ENV);
echo ("</pre>");
die;
// (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/../.env');

include __DIR__ . '/routes/pages.php';

use App\Controller\Http\Router;

Router::run();
