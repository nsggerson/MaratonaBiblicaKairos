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
                if (empty($this->global->proceduremodel("SELECT * FROM tbl_008_score WHERE fkquestion =" . $pergunta->idQuestion))) {
                    # code...
                    $table = $this->global->proceduremodel($this->global->getValueNull());
                    for ($i = 0; $i < count($table); $i++) {
                        $element = $table[$i];
                        if ($element->fkgroups == $request->get->id) {
                            print_r($element->fkquestion);
                            return;
                        }
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
                return;
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function delete($request)
    {
        foreach ($this->global->proceduremodel("SELECT id FROM tbl_004_queue WHERE fkquestion=" . $request->get->id) as $value) {
            try {
                $this->global->delete($value->id);
            } catch (\Exception $e) {
                return $e;
            }
        }
        return;
    }
}
