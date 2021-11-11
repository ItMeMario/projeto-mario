<?php
namespace App\Middleware;


//Cria a classe autenticador 
class Autenticator
{
    
    const TIPO_ALUNO = "Aluno";
    const TIPO_COORDENADOR = "Coordenador";
    const TIPO_ADMIN = "Administrador";

    public static function eSessaoValida(){

        return isset($_SESSION['login']) && $_SESSION['login']['ehLogado'] == true;

    }

    public static function eAluno()
    {
        return $_SESSION['login']['funcao'] == self::TIPO_ALUNO;
    }

    public static function eCoordenador()
    {
        return $_SESSION['login']['funcao'] == self::TIPO_COORDENADOR;
    }

    public static function eAdmin()
    {
        return $_SESSION['login']['funcao'] == self::TIPO_ADMIN;
    }
        
    public static function getNome(){
        return $_SESSION['login']['nome'];
    }

    public static function getId(){
        return $_SESSION['login']['id'];
    }
   
}
