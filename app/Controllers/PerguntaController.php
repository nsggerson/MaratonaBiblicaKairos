<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Core\Event;

class PerguntaController extends BaseController
{
    use Authenticate;

    private $global;
    

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Pergunta");
        
    }

    public function question(){
        return print_r(file_get_contents("../storage/repository/json/question.json"));
    }

    # Função trás a pergunta na modal
    public function show($request)
    {          
        return print_r(json_encode($this->global->proceduremodel($this->global->positiveBalance($request->get->id)),JSON_PRETTY_PRINT));       
    }
    
    /*
    # Funcition para modal
    public function modal($request){

        if($request->get->df == 'charge'){
            //print_r(json_encode($request->get->id,JSON_PRETTY_PRINT));
            print_r(json_encode($this->global->proceduremodel("SELECT * FROM `002_perguntas` WHERE id=".$request->get->id),JSON_PRETTY_PRINT));
            return;
        }
        if($request->get->df == 'delete'){            
            try {                
                $this->global->delete($request->get->id);
            } catch (\Exception $e) {
                return $e;
            }
            print_r(json_encode(['#$result'],JSON_PRETTY_PRINT));
            return;
        }
        
    }*/
}
