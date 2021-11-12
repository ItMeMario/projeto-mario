<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Middleware\Autenticator;

return function (App $app) {
    $container = $app->getContainer();
    $mw = function ($request, $response, $next) {
        if (!Autenticator::eCoordenador()) {
            $response->getBody()->write('Você não tem permissão para acessar esta página');
            return $response;
        }

        $response = $next($request, $response);


        return $response;
    };

    $app->get('/coordenacao/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/coordenacao/' route");

    
        $conexao = $container->get('pdo'); //conexão com o banco
        $resultSet = $conexao->query('SELECT * FROM evento
                                      WHERE usuario_id = "' . $_SESSION['login']['id'] . '"  ')->fetchAll();
        $args['eventos'] = $resultSet;

        $resultSet = $conexao->query('SELECT * FROM evento')->fetchAll();
        $args['eventos_todos'] = $resultSet;


        
        // Render index view
        return $container->get('renderer')->render($response, 'coordenacao.phtml', $args);
    })->add($mw);

};
