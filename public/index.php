<?php

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;


return function (array $context) {
    // Create an instance of Symfony core
    $kernel = new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);

    // Manage the request via the kernel
    $request  = Request::createFromGlobals();
    $response = $kernel->handle($request);
    $response->send();
    $kernel->terminate($request, $response);

    // You can return something here if necessary
    // return $someValue;
};