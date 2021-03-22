<?php

namespace App\Controllers;



use App\Models\FatorEstresse;
use Core\Container;
use Core\Authenticate;
use Core\Auth;
use Core\BaseController;
use Core\DataHora;
use Core\Redirect;
use Core\Session;
use Core\Validator;
use Illuminate\Support\Composer;

class AdministratorController extends BaseController
{ 
    private $Administrator;
    
    use Authenticate;

    public function __construct(){
        parent::__construct();
        $this->setores = Container::getModel("Admin");                
    }

    public function index(){ 
                    
        $this->setPageTitle('Administrador');             
        return $this->renderView('adm/index', 'layout');
    }

}