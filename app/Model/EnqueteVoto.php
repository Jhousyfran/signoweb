<?php

namespace App\Model;

use Signo\Http\Model;

class EnqueteVoto extends Model {
    
    protected $table = 'enquete_votos';
    protected $primaryKey = 'id';

    public static function respostas($enquete_id){
        
        $respostas = (new EnqueteResposta)->where('enquete_id', $enquete_id);
        $respostasEvotos = [];

        foreach ($respostas as $key => $resposta) {
            $votos = (new EnqueteVoto)->where('resposta_id', $resposta->id);
            $repostaVotos = new \StdClass();
            $repostaVotos->id = $resposta->id;
            $repostaVotos->votos = count($votos);
            $repostaVotos->resposta = $resposta->resposta;
            array_push($respostasEvotos, $repostaVotos);
        };

        return $respostasEvotos;
    }
}

