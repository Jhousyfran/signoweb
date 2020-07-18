<?php

/* 
*    Este é o nosso arquivo que gerencia as rotas
*    Ex: $rota->get|post()("/suarota","Controller@metodo");
*/

$rota->get("/","EnqueteController@index");
$rota->get("/nova","EnqueteController@create");
$rota->post("/nova","EnqueteController@store");
$rota->post("/editar","EnqueteController@update");
$rota->get("/enquetes/editar", "EnqueteController@list");
$rota->get("/enquete/[i:id]", "EnqueteController@enquete");
$rota->get("/enquete/[i:id]/editar", "EnqueteController@create");
$rota->get("/enquete/[i:id]/excluir", "EnqueteController@delete");
$rota->post("/enquete/[i:id]/votar", "EnqueteController@votar");