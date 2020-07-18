<?php

namespace App\Model;

use Signo\Http\Model;

class Enquete extends Model {
    
    protected $table = 'enquetes';
    protected $primaryKey = 'id';


    public static function respostas($enquete_id)
    {
        $respostas = (new EnqueteResposta)->where('enquete_id', $enquete_id);

        if(!$respostas || !count($respostas))
            return [];
        
        return $respostas;
    }

}

