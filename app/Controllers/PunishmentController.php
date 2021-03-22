<?php

namespace App\Controllers;

use App\Models\Fila;
use Core\BaseController;
use Core\Authenticate;
use Core\Container;


class PunishmentController extends BaseController
{
    use Authenticate;
    private $global;


    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Punishment");
    }

    public function store($request)
    { 
        $data = [
            'fkgroups' => $request->get->id,
            'content' => $request->get->content,
            'value' => $request->get->value
        ];  
       
        try {
            if ($this->global->create($data)) {
                print_r((int)$request->get->id);
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
