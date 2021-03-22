<?php

namespace App\Controllers;

use Core\Container;
use Core\DataBase;
use Core\Generate_json_files;

class LogsController {
   // use Authenticate;
    private $global;
    use Generate_json_files;

    public function __construct()
    {
        //parent::__construct();
        $this->global = Container::getModel("Log");
    }

    public function index(){
        //$this->global->All();

       // print_r($this->global('Log')->All());
        //echo '<br>';
        
        //$this->load(['question',1]);
        $this->create_file_json(['table'=>'question','idQuestion'=>4]);
        //print_r($this->loadQuestion());


        /*
        $modelII = $this->global('Log');
        print_r($model->foreignkey('users')[0]);*/
        return;
    }

}
