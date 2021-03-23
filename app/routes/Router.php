<?php

use Laminas\Diactoros\ResponseFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new ResponseFactory();

$strategy = new JsonStrategy($responseFactory);
$router   = (new Router)->setStrategy($strategy);

// здесь прописываются роуты
$router->map('GET', '/', 'App\Controllers\IndexController::index');

$response = $router->dispatch($request);

(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);