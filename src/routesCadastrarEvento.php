<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastrarEvento/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastrarEvento/' route");

        if ($_SESSION['login']['ehLogado'] != true) {
            return $response->withRedirect('/login/');
            exit;
        }
        
        // Render index view
        return $container->get('renderer')->render($response, 'cadastrarEvento.phtml', $args);
    });

    $app->post('/cadastrarEvento/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastrarEvento/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $nome_evento = $_POST['nome_evento'];
        $descricao_evento = $_POST['descricao_evento'];
        $tipo_evento = $_POST['tipo_evento'];

        $resultSet = $conexao->query("INSERT INTO evento (nome_evento, descricao_evento, tipo_evento)
                                    VALUES ('$nome_evento', 
                                            '$descricao_evento',
                                            '$tipo_evento')");

        return $response->withRedirect('/cadastrarEvento/');
    });
};
