<?php

namespace App\Controllers;


use Core\BaseController;
use Core\Authenticate;
use Core\Container;
use Core\DataHora;
use Core\Load_json;
use Core\Event;


class PainelController extends BaseController
{
    use Authenticate;
    use DataHora;
    use Load_json;
 

    private $global;

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Painel");
    }

    public function index()
    {
        if (Event::validateFileJson(2)) {            
            Event::event('1,3,6,7');
        }else {
            Event::event('0');
        }        
        return $this->renderView('/painel/index');
    }

    public function question()
    {
        //print_r($this->load(['table'=>'question','idQuestion'=>3]));
        return print_r($this->loadQuestion());
        
    }

    public function operando(){
        return print_r($this->getShowGroups());
    }
    /*
    public function tempo($request){        
        //print_r();
        //print_r(json_encode($this->global->proceduremodel($this->global->progress()), JSON_PRETTY_PRINT));
        return;
    }*/

    public function groups()
    {      
        return print_r($this->getGroups());
    }

    public function show($request){
        //$event= Event::event([1,2]);
        //print_r($event); 
        return print_r(file_get_contents("../storage/repository/json/event.json"));
        
    }

    
    
    public function store($request){
        //$exp = explode(',',$request->get->df); 
        Event::event($request->get->df);
        return true;        
    }
}
