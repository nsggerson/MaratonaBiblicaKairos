<?php

namespace App\Models;

use Core\BaseModel;
use Core\DataHora;


#class Paciente extends BaseModelEloquent
class Pontos extends BaseModel
{
    protected $table = "tbl_008_score";



    public function model_perguntas_grupos_edit($param)
    {
        return "SELECT A.id, C.type , A.pergunta, B.name AS grpQuest, A.ponto FROM `002_perguntas` A
        INNER JOIN `005_grupo` B , `001_typePergunta` C
        ON B.id = A.fkgrupo AND C.id= A.fktype
        WHERE A.id= $param";
    }

    //Pega o ultimo valor da tabela
    public function progress()
    {
        return ("SELECT MAX(A.id) AS id
            ,A.fkgroups
            ,B.name
            ,A.time
            ,A.status
            FROM tbl_011_timeEstimate AS A
            INNER JOIN tbl_005_groups AS B
            ON B.id = A.fkgroups");
    }
}
