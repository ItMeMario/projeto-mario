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
        $usuario_id = $_SESSION['login']['id'];
        $data_evento_inicio = $_POST['data_evento_inicio'];
        $data_evento_fim = $_POST['data_evento_fim'];
        $data_inscricao_inicio = $_POST['data_incricao_inicio'];
        $data_inscricao_fim =$_POST['data_inscricao_fim'];


        $resultSet = $conexao->query("INSERT INTO evento (nome_evento, descricao_evento, tipo_evento, usuario_id,data_evento_inicio,data_evento_fim,data_inscricao_inicio,data_inscricao_fim)
                                    VALUES ('$nome_evento', 
                                            '$descricao_evento',
                                            '$tipo_evento',
                                            '$usuario_id',
                                            '$data_evento_inicio',
                                            '$data_evento_fim',
                                            '$data_inscricao_inicio',
                                            '$data_inscricao_fim'
                                            )");

        return $response->withRedirect('/cadastrarEvento/');
    });
};
