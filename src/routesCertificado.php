<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/certificado/[{id}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/certificado/' route");

        if ($_SESSION['login']['ehLogado'] != true) {
            return $response->withRedirect('/login/');
            
        }
        $conexao = $container->get('pdo'); //conexão com o banco

        $resultSet = $conexao->query('SELECT * FROM usuario_evento
        WHERE usuario_id = "' . $_SESSION['login']['id'] . '"  ')->fetchAll();
        $args['usuario_eventos'] = $resultSet;

        $resultSet = $conexao->query('SELECT * FROM usuario_evento')->fetchAll();
        $args['eventos_todos'] = $resultSet;


        // Render index view
        return $container->get('renderer')->render($response, 'certificado.phtml', $args);
    });
};
