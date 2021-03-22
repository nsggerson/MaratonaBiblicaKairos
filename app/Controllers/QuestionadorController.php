<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Dotenv\Regex\Result;

class QuestionadorController extends BaseController
{
    use Authenticate;

    private $global;
   

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Questionador");
        
    }

    public function index()
    {
        # Tras os grupos dos sistema
        print_r(json_encode($this->global->All(), JSON_PRETTY_PRINT));
        return;
    }

    public function show($request)
    {
     
        $data = [
            'idQuestion' => null,
            'idGroups' => null,
            'name' => 'Sem perguntas',
            'qtd' => 0
        ];
        $qtd = 0;
        foreach ($this->global->proceduremodel($this->global->positiveBalance($request->get->id)) as $value) {
            # Verifica na tabela  tbl_008_score se existe valor do id fkquestion
            if (empty($this->global->proceduremodel("SELECT id FROM tbl_008_score WHERE fkquestion = $value->idQuestion"))) {
                $qtd += 1;
                $data = [
                    'idQuestion' => $value->idQuestion,
                    'idGroups' => $value->idGroups,
                    'name' => $value->name,
                    'qtd' => $qtd
                ];
            }
        }
        print_r(json_encode([$data], JSON_PRETTY_PRINT));
        return;
    }

    
}