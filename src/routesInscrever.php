<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/inscrever/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inscrever/' route");

        $conexao = $container->get('pdo');
       $id = $_SESSION['login']['id'];
       $evento = $args['id'];
       
    //    SELECT $id and $evento from usuario_evento
        $resultSet = $conexao->query ("INSERT INTO usuario_evento (usuario_id,evento_id) values ('$id','$evento')");

        return $response->withRedirect('/inicio/');
    });
};
