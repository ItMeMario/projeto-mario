<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/aluno/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/aluno/' route");

        if ($_SESSION['login']['ehLogado'] != true) {
            return $response->withRedirect('/login/');
           
        }
        $conexao = $container->get('pdo'); //conexão com o banco
        $resultSet = $conexao->query('SELECT E.*, U.nome FROM evento AS E
                                        LEFT JOIN usuario_evento AS UE ON E.id = UE.id_evento
                                        LEFT JOIN usuario AS U ON UE.id_usuario = U.id')->fetchAll();
        $args['eventos'] = $resultSet;

        //mostrar nome_evento, tipo_evento e data_evento

        // Render index view
        return $container->get('renderer')->render($response, 'aluno.phtml', $args);
    });

};
