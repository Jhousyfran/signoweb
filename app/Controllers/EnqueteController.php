<?php

namespace App\Controllers;

use App\Controllers\BaseController\MasterController;
use App\Model\Enquete;

class EnqueteController extends MasterController
{
    function __construct()
    {
        $this->enquete = new Enquete();
    }

    public function index()
    {
        $enquetes = $this->enquete->all();
        return $this->service->render('home.phtml', [ 'enquetes' => $enquetes]);
    }

    public function create()
    {
        return $this->service->render('Enquete/nova.phtml');
    }

    public function store()
    {
        $data = array(
            'titulo' => $_POST['titulo'],
            'data_inicio' => $_POST['data_inicio'],
            'data_fim' => $_POST['data_fim'],
            'criado_em' => now()
        );


        try {
            $enquete = new Enquete();
            $enquete = $enquete->save($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if(!$enquete)
            return 'ERROR';
        
        return $this->response->redirect(url('/'))->send();  
    }

}