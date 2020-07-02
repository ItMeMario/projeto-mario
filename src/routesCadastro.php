<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastro/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'cadastro.phtml', $args);
    });

    $app->post('/cadastro/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $funcao = $_POST['funcao'];

        $resultSet = $conexao->query ("INSERT INTO usuario (nome, email, senha, funcao) 
                                    VALUES ('$nome', 
                                            '$email', 
                                            '$senha', 
                                            '$funcao')");

        return $response->withRedirect('/login/');
    });
};
