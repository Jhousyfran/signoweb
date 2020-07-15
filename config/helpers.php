<?php

//Arquivo com funções de ajuda



#Função Para passa o url base do projeto
function assets($file){
    $protocol   = strtolower(preg_replace("/[^a-zA-Z\s]/",'',$_SERVER["SERVER_PROTOCOL"]));
    $serve_name = $_SERVER["SERVER_NAME"];
    $port       = $_SERVER["SERVER_PORT"] == "80" ? "" : ":".$_SERVER["SERVER_PORT"];
    $scriptname = str_replace("/index.php","",$_SERVER["SCRIPT_NAME"]);

    return  "{$protocol}://{$serve_name}{$scriptname}/app/Public/{$file}";

}

function url($rota){
    $protocol   = strtolower(preg_replace("/[^a-zA-Z\s]/",'',$_SERVER["SERVER_PROTOCOL"]));
    $serve_name = $_SERVER["SERVER_NAME"];
    $port       = $_SERVER["SERVER_PORT"] == "80" ? "" : ":".$_SERVER["SERVER_PORT"];
    $scriptname = str_replace("/index.php","",$_SERVER["SCRIPT_NAME"]);

    return "{$protocol}://{$serve_name}{$scriptname}{$rota}";

}

function isEmptyOrNull($variavel){
    if(isset($variavel) && !empty($variavel))
        return $variavel;
    
    return '';
}

