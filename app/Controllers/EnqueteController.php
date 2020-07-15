<?php

namespace App\Controllers;

use App\Controllers\BaseController\MasterController;

class EnqueteController extends MasterController
{
    

    public function index()
    {
        return $this->service->render('home.phtml');
    }

    public function create()
    {
        return $this->service->render('Enquete/nova.phtml');
    }

}