<?php

namespace App\Controllers;

use App\Models\Fila;
use Core\BaseController;
use Core\Authenticate;
use Core\Container;
use Core\DataHora;


class PontosController extends BaseController
{
    use Authenticate;
    //use LogsController;
    use DataHora;
    private $global;


    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Pontos");
    }

    public function store($request)
    {
        $data = [
            'fkgroups' => $request->get->idGroups,
            'fkquestion' => $request->get->idPergs
        ];        

        try {
            if ($this->global->create($data)) {
                //$this->log_success($this->global->proceduremodel($this->global->progress())[0]->fkgroups,$request->get->idPergs);               
                return;
            }
        } catch (\Exception $e) {
            return $e;
        }
    }


    //Pega a pergunta que esta para este grupo
    public function delete($request)
    {
        // tras o registrou com id pergunta como parametro de pesquisa
        $registro = $this->global->findParam(['fkquestion',$request->get->id]);
        // Delete somente para um id
        if ($request->get->tp == 'find') {
            try {
                if ($this->global->delete($registro[0]->id)) {                    
                    print_r(json_encode([TRUE,$registro[0]->id], JSON_PRETTY_PRINT));
                    return;
                }
            } catch (\Exception $e) {
                return $e;
            } 
        }
        if ($request->get->tp == 'all') {
            $registro = (int)$this->global->proceduremodel("SELECT id FROM `008_ponto` WHERE fkpergunta= {$request->get->idPerg}")[0]->id;

            if ($this->global->delete($registro)) {
                print_r('Resgistro excluido');
                return;
            }
        }
    }
}
