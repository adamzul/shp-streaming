<?php
use Slim\Views\PhpRenderer;
require 'vendor/autoload.php';

$app = new Slim\App();
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./view");

$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->getBody()->write("Hello, " . $args['name']);
});

$app->get('/view', function ($request, $response, $args) {
    return $this->renderer->render($response, "view.html");
});

$app->get('/api/{param}', function ($request, $response, $args) {
	$str = file_get_contents('./'.$args['param'].'.geojson');
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write($str);
});

$app->run();