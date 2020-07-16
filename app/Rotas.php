<?php

/* 
*    Este é o nosso arquivo que gerencia as rotas
*    Ex: $rota->get|post()("/suarota","Controller@metodo");
*/

$rota->get("/","EnqueteController@index");
$rota->get("/nova","EnqueteController@create");
$rota->post("/nova","EnqueteController@store");