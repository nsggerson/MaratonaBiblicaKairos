<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Dotenv\Regex\Result;

class RespostaController extends BaseController
{
    use Authenticate;

    private $global;
   

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel('Resposta');
        
    }

    public function show($request){
        var_dump($this->global->proceduremodel("SELECT * FROM tbl_002_answer"));
    }
}