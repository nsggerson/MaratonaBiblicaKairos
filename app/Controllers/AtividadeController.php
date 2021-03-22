<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Dotenv\Regex\Result;

class AtividadeController extends BaseController
{
    use Authenticate;

    private $global;
   

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Atividade");
        
    }

    public function index()
    {
        # Tras os grupos dos sistema
        print_r(json_encode($this->global->All(), JSON_PRETTY_PRINT));
        return;
    }


    
}