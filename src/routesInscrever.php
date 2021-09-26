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
        $repetido = $conexao->query("SELECT * FROM usuario_evento where usuario_id = '$id' and evento_id ='$evento'")->fetchAll();

        if(sizeof($repetido)==0){
            $resultSet = $conexao->query("INSERT INTO usuario_evento (usuario_id,evento_id) values ('$id','$evento')");
        }
     
        //  

        return $response->withRedirect('/inicio/');
    });

    $app->post('/inscrever/[{id}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inscrever/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $usuario_id = $_SESSION['login']['id'];
        $evento_id = $args['id'];



        $resultSet = $conexao->query("INSERT INTO usuario_evento (usuario_id,evento_id) values ('$usuario_id','$evento_id')");

        return $response->withRedirect('/inicio/');
    });
};
