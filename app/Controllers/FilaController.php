<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Core\DataHora;
use Core\Generate_json_files;
use Core\Event;

class FilaController extends BaseController
{
    use Authenticate;
    use DataHora;
    //use Logs;
    use Generate_json_files;
    private $global;
    private $tbl_pergunta;
    private $tbl_pontos;
    private $tbl_fila;

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Fila");
        $this->tbl_pergunta = $this->global->proceduremodel("SELECT * FROM `tbl_002_question`");
        $this->tbl_pontos = $this->global->proceduremodel("SELECT * FROM `tbl_008_score`");
    }


    function index()
    {
        print_r(json_encode($this->global->All('DISTINCT(fkquestion) AS fkpergunta'), JSON_PRETTY_PRINT));
        return;
    }

    public function find($request)
    {
        # Funcition para sorteio de pergunta
        $array = [];
        $pergs  = $this->global->proceduremodel($this->global->positiveBalance($request->get->id));
        if ($request->get->qtd == 1) {
            foreach ($pergs as $pergunta) {

                // Verificando se a pergunda esta dentro do tbl_008_score
                if (empty($this->global->proceduremodel("SELECT * FROM tbl_008_score WHERE fkquestion =" . $pergunta->idQuestion))) {
                    # code...
                    // Verificando se a pergunta esta dentro de tbl_015_canceledQuestions
                    if (empty($this->global->proceduremodel("SELECT * FROM tbl_015_canceledQuestions WHERE id=" . $pergunta->idQuestion))) {
                        $table = $this->global->proceduremodel($this->global->getValueNull());
                        for ($i = 0; $i < count($table); $i++) {
                            $element = $table[$i];
                            if ($element->fkgroups == $request->get->id) {
                                print_r($element->fkquestion);
                                return;
                            }
                        }
                    }else{
                        print_r(0);
                    }
                }
            }
        } elseif ($request->get->qtd > 1) {
            # Armazena o id das perguntas debtri de um array
            foreach ($pergs as $value) {
                # code...
                $array[] = $value->idQuestion;
            }
            do {
                $key = array_rand($array);
                if (empty($this->global->proceduremodel("SELECT * FROM tbl_008_score WHERE fkquestion =" . $array[$key]))) {
                    print_r($array[$key]);
                    return TRUE;
                }
            } while (TRUE);
            return;
        }
    }

    public function store($request)
    {
        $data = [
            'fkquestion' => $request->get->id
        ];
        try {
            Event::setQuestion($this->global->proceduremodel($this->global->getTheQuestion($request->get->id)));
            if ($this->global->create($data)) {
                $data = [
                    "idGroups" => $request->get->idGroups,
                    "nmGroups" => $request->get->nmGroups
                ];
                //$this->create7_file_json(['table'=>'question','idQuestion'=>$request->get->id]);
                Event::setShowGroups($data);
                return print_r('true');
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($request)
    {
        // Retirando a pergunta excluida pelo do grupo
        $a = $this->global->proceduremodel("SELECT id FROM tbl_008_score WHERE fkquestion=".$request->get->id);
        // Retirando a pergunta excluida dos pontos anulados  
        $b = $this->global->proceduremodel("SELECT id FROM tbl_015_canceledQuestions WHERE id=".$request->get->id);
        foreach ($this->global->proceduremodel("SELECT id FROM tbl_004_queue WHERE fkquestion=" . $request->get->id) as $value) {
            try {
                $this->global->delete($value->id);
                if(!empty($a)){
                    $this->global->deleteOfNameTable('tbl_008_score', $a[0]->id);
                }                
                if (!empty($b)) {                   
                    $this->global->deleteOfNameTable('tbl_015_canceledQuestions', $b[0]->id);
                }   
                
            } catch (\Exception $e) {
                return $e;
            }
        }            
        return;
    }
}
