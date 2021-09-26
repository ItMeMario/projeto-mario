<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

// Inicializar sessão
session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/routesAluno.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesCadastrarEvento.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesCadastro.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesCoordenacao.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesEditar.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesExcluir.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesInicio.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesLogin.php';
$routes($app);

$routes = require __DIR__ . '/../src/routesInscrever.php';
$routes($app);

// $routes = require __DIR__ . '/../src/routesGerarCertificado.php';
// $routes($app);

// $routes = require __DIR__ . '/../src/routesCertificado.php';
// $routes($app);


// Run app
$app->run();
