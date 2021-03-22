<?php

namespace App\Controllers;


use Core\BaseController;
use Core\Authenticate;
use Core\Container;


class ControladorController extends BaseController
{
    use Authenticate;
    private $global;


    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Controlador");
    }

    public function index()
    {
        /*$grupos = $this->global->proceduremodel("SELECT * FROM `005_grupo`");
        // Get os grupos e somando os pontos com $this->somaPontos
        /*$this->view->allGrupos = [
            'name' => $grupos[0]->name,
            'ponto' => $this->somaPontos($grupos[0]->id),
            'all' => $grupos
        ];*/
        //$this->view->carregarEquipe = $this->loadPainelgroups()[0]->nmGrup;
        //$this->view->pontos = $this->loadPainelgroups();
        //$this->view->painelFilaAdd = $this->global->proceduremodel(" SELECT DISTINCT fkpergunta FROM `004_fila`");
        return $this->renderView('/controlador/index', 'layout');
    }
}
