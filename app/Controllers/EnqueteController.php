<?php

namespace App\Controllers;

use App\Controllers\BaseController\MasterController;
use App\Model\Enquete;
use App\Model\EnqueteResposta;
use App\Model\EnqueteVoto;

class EnqueteController extends MasterController
{
    function __construct()
    {
        $this->enquete = new Enquete();
        $this->resposta = new EnqueteResposta();
    }

    public function index()
    {
        $enquetes = $this->enquete->all();
        return $this->service->render('home.phtml', [ 'enquetes' => $enquetes]);
    }

    public function create()
    {
        $enquete = new Enquete();
        $id = $this->request->id ? $this->request->id : false ;

        if($id){
            $enquete = $enquete->find($id);
            if(!$enquete->id || $enquete->data_fim <= date('Y-m-d')) return $this->response->redirect(url('/'))->send();
            $respostas = Enquete::respostas($enquete->id);
        }

        return $this->service->render('Enquete/nova.phtml', ['enquete'=> $enquete, 'respostas' => $respostas]);
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
            EnqueteResposta::createOrUpdate($enquete, $_POST['resposta']);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if(!$enquete)
            return 'ERROR';
        
        return $this->response->redirect(url('/enquete/'.$enquete))->send();  
    }

    public function update()
    {

        $id = $this->request->id ? $this->request->id : false ;
        $enquete = (new Enquete)->find($id);
        if(!$enquete->id) return $this->response->redirect(url('/'))->send();

        $data = array(
            'titulo' => $_POST['titulo'],
            'data_inicio' => $_POST['data_inicio'] ?? $enquete->data_inicio,
            'data_fim' => $_POST['data_fim'] ?? $enquete->data_fim
        );

        try {
            if(isset($_POST['resposta']) && isset($_POST['data_inicio']) && ($_POST['data_inicio'] > date('Y-m-d'))){
                EnqueteResposta::createOrUpdate($enquete->id, $_POST['resposta']);
            }

            $enquete = $this->enquete->update($data, $enquete->id, false);
           
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if(!$enquete)
            return 'ERROR';
        
        return $this->response->redirect(url('/enquete/'.$id))->send();  
    }

    public function enquete()
    {
        $id = $this->request->id ? $this->request->id : false ;

        if(!$id) return $this->response->redirect(url('/'))->send();

        $enquete = $this->enquete->find($id);
        if(!$enquete->id) return $this->response->redirect(url('/'))->send();
        $respostas = EnqueteVoto::respostas($enquete->id);
        $voto = false;

        session_start();
        if(isset($_SESSION['voto']) && $_SESSION['voto']){
            unset($_SESSION['voto']);
            $voto = true;
        }
        
        return $this->service->render('Enquete/voto.phtml', ['enquete'=> $enquete, 'respostas' => $respostas, 'voto' => $voto]);
    }

    public function list()
    {
        $enquetes = $this->enquete->all();
        return $this->service->render('Enquete/lista.phtml', [ 'enquetes' => $enquetes]);
    }

    public function votar()
    {
        $id = $this->request->id ? $this->request->id : false ;
        if(!$id) return $this->response->redirect(url('/'))->send();

        $enquete = $this->enquete->find($id);
        $resposta = $this->resposta->find($_POST['resposta']);
        if(!$enquete->id || !$resposta->id) return $this->response->redirect(url('/'))->send();

        $data = array(
            'enquete_id' => $enquete->id,
            'resposta_id' => $resposta->id,
            'criado_em' => now()
        );

        try {
            $enquete_voto = (new EnqueteVoto())->save($data);
            if(!$enquete_voto)
                return "ERROR";
        } catch (\Exception $e) {
            return "ERROR: {$e->getMessage()}";
        }

        session_start();
        $_SESSION['voto'] = true;

        return $this->response->redirect(url('/enquete/'.$id))->send();

    }

    public function delete()
    {
        $enquete = new Enquete();
        $id = $this->request->id ? $this->request->id : false ;

        if($id){
            $enquete = $enquete->find($id);
            if(!$enquete->id) return $this->response->redirect(url('/'))->send();
        }

        $this->enquete->delete($id);

        return $this->response->redirect(url('/enquetes/editar'))->send();
        
    }

}