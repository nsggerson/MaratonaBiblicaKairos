<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class Grupo extends BaseModel
{

    //public $table = "users";
    protected $table = "tbl_005_groups";


    /**
     * Undocumented function
     * tbl_007_atividade
     * @return void
     */
    function loadGroups()
    {
        return ("SELECT DISTINCT B.id AS idGroups,
            B.name AS nmGroups        
            FROM tbl_006_participants AS A
            LEFT JOIN tbl_005_groups AS B
            ON A.fkgroups = B.id ");
    }


    function groupsScore($param)
    {
        return ("SELECT D.id AS idGroups
            ,D.name AS nameGroups
            ,A.id AS id
            ,A.text AS content
            ,A.kindofquestion AS idType
            ,B.type AS type
            ,B.value AS ponto
            FROM tbl_002_question AS A
            
            --Buscando o tipo de pergunta
            INNER JOIN tbl_001_KindOfQuestion AS B
            ON B.id = A.kindofquestion
            
            --Verificando se este valor esta pontuado
            INNER JOIN tbl_008_score AS C , tbl_005_groups AS D
            ON C.fkquestion = A.id AND D.id = C.fkgroups
            WHERE D.id = $param");
    }

    //Função para definir o andamento do painel
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
