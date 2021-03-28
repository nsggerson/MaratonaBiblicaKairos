<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Core\Event;
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
        try {
            //code...            
            Event::setQuestion($this->global->proceduremodel($this->global->getTheAnswer($request->get->id)));
            Event::event('1,3,6');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }
}