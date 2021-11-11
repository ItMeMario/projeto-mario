<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Middleware\Autenticator;

return function (App $app) {
    $container = $app->getContainer();
    $mw = function ($request, $response, $next) use ($container) {
        if (!Autenticator::eSessaoValida()) {
            return $response = $response->withRedirect("/login/");
        }
        if (!Autenticator::eCoordenador()) {
            $response->getBody()->write('Você não tem permissão para acessar esta página');
            return $response;
        }

        $response = $next($request, $response);

        return $response;
    };

    $app->get('/cadastrarEvento/[{sucesso}]', function (Request $request, Response $response, array $args) use ($container) {

        return $container->get('renderer')->render($response, 'cadastrarEvento.phtml', $args);
    })->add($mw);

    $app->post('/cadastrarEvento/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message

        $conexao = $container->get('pdo');

        $request->getParsedBody();

        $nome_evento = $_POST['nome_evento'];
        $descricao_evento = $_POST['descricao_evento'];
        $tipo_evento = $_POST['tipo_evento'];
        $usuario_id = $_SESSION['login']['id'];
        $data_evento_inicio = $_POST['data_evento_inicio'];
        $data_evento_fim = $_POST['data_evento_fim'];
        $data_inscricao_inicio = $_POST['data_incricao_inicio'];
        $data_inscricao_fim = $_POST['data_inscricao_fim'];


        $conexao->query("INSERT INTO evento (nome_evento, descricao_evento, tipo_evento, usuario_id,data_evento_inicio,data_evento_fim,data_inscricao_inicio,data_inscricao_fim)
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
    })->add($mw);
};
