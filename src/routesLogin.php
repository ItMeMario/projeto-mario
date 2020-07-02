<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/login/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inicio/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'login.phtml', $args);
    });

    $app->post('/login/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/login/' route");

        //Conectando com o Banco de Dados
        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        //Seleção de e-mail e senha inseridos no input (com hash md5)
        $resultSet = $conexao->query('SELECT * FROM usuario 
                                      WHERE email = "' . $params['email'] . '" 
                                            AND senha = "' . md5($params['senha']) . '"')->fetchAll();

        // Validação do e-mail e da senha
        if (count($resultSet) == 1) {
            $_SESSION['login']['ehLogado'] = true;
            $_SESSION['login']['nome'] = $resultSet[0]['nome'];         
            return $response->withRedirect('/inicio/');
        } else {
            $_SESSION['login']['ehLogado'] = false;

            return $response->withRedirect('/login/fail');
        }
    });

    $app->get('/sair/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inicio/' route");

        //Destruição da sessão
        session_destroy();

        // Render index view
        return $container->get('renderer')->render($response, 'login.phtml', $args);
    });

};
