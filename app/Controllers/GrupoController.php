<?php

namespace App\Controllers;

use App\Models\Grupo;
use App\Models\Logs;
use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Dotenv\Regex\Result;
use Core\Event;
use Core\DataHora;
use Core\Generate_json_files;


class GrupoController extends BaseController
{
    use Authenticate;
    use DataHora;
    use Generate_json_files;
    //use Logs;


    private $global;
    private $logs;




    //generateQuestionNumber

    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Grupo");
        //$this->logs = new LogsController;
    }


    public function index()
    {
        $groups_tbl = $this->global->proceduremodel($this->global->loadGroups());
        if (!empty($groups_tbl)) {
            foreach ($groups_tbl as $groups) {
                # Pegando os pontos dos grupos
                $score  = $this->global->proceduremodel($this->global->groupsScore($groups->idGroups));
                if (!empty($score)) {
                    $pontos = 0;
                    $pergs = '';
                    foreach ($score as $a) {
                        $pontos += $a->ponto;
                        if ($pergs == '') {
                            $pergs = $a->id;
                        } else {
                            $pergs = $pergs . ',' . $a->id;
                        }
                    }
                    # Representa a perca de ponto dos grupos
                    foreach ($this->global->proceduremodel("SELECT * FROM tbl_009_punishment WHERE fkgroups=" . $groups->idGroups) as $rev) {
                        # code...
                        if (!empty($pontos)) {
                            $pontos = (float)$pontos - (float)$rev->value;
                        }
                    }
                    foreach ($this->global->proceduremodel("SELECT * FROM tbl_010_addPunctuation WHERE fkgroups=" . $groups->idGroups) as $add) {
                        # code...
                        if (!empty($pontos)) {
                            $pontos = (float)$pontos + (float)$add->value;
                        }
                    }
                } else {
                    $pontos = '';
                    $pergs = '';
                }
                $data[] = [
                    'id' => $groups->idGroups,
                    'name' => $groups->nmGroups,
                    'pontos' => (float)$pontos,
                    'acertos' => explode(',', $pergs)
                ];
            }

            print_r($this->setGroups(json_encode($data, JSON_PRETTY_PRINT)));
            return;
            
        }
        $data[] = [
            'id' => null,
            'name' => null,
            'pontos' => null,
            'acertos' => 0
        ];

        print_r(json_encode($data, JSON_PRETTY_PRINT));
        return;
    }

    public function show($request)
    {
        $groups_tbl = $this->global->proceduremodel($this->global->loadGroups());
        $quant = count($groups_tbl);
        
        if (!empty($groups_tbl)) {
            for ($i = 0; $i < count($groups_tbl); $i++) {
                $element = $groups_tbl[$i];
                if ($request->get->df == 'next') {
                    if ($element->idGroups == $request->get->id) {
                        if ($i < $quant - 1) {
                            $i++;
                            print_r(json_encode($groups_tbl[$i], JSON_PRETTY_PRINT));
                            return;
                        }
                        print_r(json_encode(reset($groups_tbl), JSON_PRETTY_PRINT));
                        return;
                    }
                } elseif ($request->get->df == 'back') {
                    if ($element->idGroups == $request->get->id) {
                        if ($i != 0) {
                            $i--;
                            print_r(json_encode($groups_tbl[$i], JSON_PRETTY_PRINT));
                            return;
                        }
                        print_r(json_encode(end($groups_tbl), JSON_PRETTY_PRINT));
                        return;
                    }
                } elseif ($request->get->df == 'pass') {
                    if ($element->idGroups == $request->get->id) {
                        if ($i < $quant - 1) {
                            $i++;
                            $r = $groups_tbl[$i];
                            $data = [
                                'idGroups'=> $r->idGroups,
                                'nmGroups'=> $r->nmGroups
                            ];                            
                            return print_r(Event::setShowGroups($data));                            
                            
                        }
                        $r = $groups_tbl[$i];
                            $data = [
                                'idGroups'=> $r->idGroups,
                                'nmGroups'=> $r->nmGroups
                            ];                            
                            return print_r(Event::setShowGroups($data));   
                    }
                }
            }
        }
        print_r('error 0002');
        return;
    }
}
