<?php

namespace App\Model;

use Signo\Http\Model;

class EnqueteResposta extends Model {
    
    protected $table = 'enquete_respostas';
    protected $primaryKey = 'id';


    public static function createOrUpdate($enquete_id, Array $respostas)
    {
        $respostas_old = (new EnqueteResposta)->where('enquete_id', $enquete_id);

        if(count($respostas_old)){
            foreach ($respostas_old as $resposta_old) {
                (new EnqueteResposta())->delete($resposta_old->id);
            }
        }

        foreach($respostas as $resposta){
            $enquete_reposta = new EnqueteResposta();
            $data = array(
                'resposta' => $resposta,
                'enquete_id' => $enquete_id
            );

            $enquete_reposta =  $enquete_reposta->save($data);
        }

    }

}

