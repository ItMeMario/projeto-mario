<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/editar/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        $conexao = $container->get('pdo');
        
        $resultSet = $conexao->query ('SELECT * FROM evento WHERE id = ' . $args['id'])->fetchAll();
        
        $_SESSION['eventoEditar']['nome_evento'] = $resultSet[0]['nome_evento'];
        $_SESSION['eventoEditar']['descricao_evento'] = $resultSet[0]['descricao_evento'];
        $_SESSION['eventoEditar']['tipo_evento'] = $resultSet[0]['tipo_evento'];
        $_SESSION['eventoEditar']['data_evento_inicio']= $resultSet[0]['data_evento_inicio'];
        $_SESSION['eventoEditar']['data_evento_fim']=$resultSet[0]['data_evento_fim'];
        $_SESSION['eventoEditar']['data_incricao_inicio']=$resultSet[0]['data_inscricao_inicio'];
        $_SESSION['eventoEditar']['data_incricao_inicio']=$resultSet[0]['data_inscricao_fim'];
        $args['editar'] = $resultSet;

        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });

    $app->post('/editarEvento/[{id}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editarEvento/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $eventoEditar = $_POST;

        $resultSet = $conexao->query('UPDATE evento SET nome_evento = "' . $eventoEditar['nome_evento'] . '",
                                                        descricao_evento = "' . $eventoEditar['descricao_evento'] . '",
                                                        tipo_evento = "' . $eventoEditar['tipo_evento'] . '",
                                                        data_evento_inicio ="'. $eventoEditar['data_evento_inicio'] . '",
                                                        data_evento_fim = "'.$eventoEditar['data_evento_fim'] . '",
                                                        data_incricao_inicio ="'. $eventoEditar['data_inscricao_inicio'] . '",
                                                        data_incricao_fim = "'. $eventoEditar['data_inscricao_fim'].'",
                                                        WHERE id = ' . $args['id'])->fetchAll();
                 
        return $container->get('renderer')->render($response, 'inicio.phtml', $args);
    });
};