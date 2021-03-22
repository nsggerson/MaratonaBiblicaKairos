<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;


//class User extends BaseModelEloquent
class Fila extends BaseModel
{

    //public $table = "users";
    protected $table = "tbl_004_queue";

    public function positiveBalance($param)
    {
        return " SELECT
                    A.id AS idQuestioner
                ,B.id AS idGroups, B.name
                ,C.id AS idQuestion, C.text
                ,D.id AS idType, D.type, D.value
            FROM 
                tbl_007_questioner  AS A
            LEFT JOIN 
                tbl_005_groups AS B,
                tbl_002_question AS C,
                tbl_001_KindOfQuestion AS D 
            ON 
                B.id= A.fkgroups 
                AND C.id= A.fkquestion
                AND D.id= C.kindofquestion
            WHERE B.id =  $param";
    }

    public function getTheQuestion($param)
    {
        return " SELECT 
                A.id
                ,A.text
                ,B.type
                ,B.value
        FROM tbl_002_question AS A
        INNER JOIN tbl_001_KindOfQuestion AS B
        ON A.kindofquestion= B.id
        WHERE A.id = $param";
    }

    public function getValueNull()
    {
        return "SELECT 
             A.id
            ,A.fkgroups
            ,A.fkquestion
        FROM tbl_007_questioner AS A
            LEFT JOIN tbl_008_score AS B
            ON (A.fkquestion = B.fkquestion)
        WHERE B.fkquestion IS NULL";
    }

    private function importModel($param){
        $model = new Pergunta();
        return $model->positiveBalance($param);
    }

    public function question($param){
        return $this->proceduremodel("SELECT A.id AS idQuestion
        ,B.id AS idType
        ,A.text AS content
        ,B.type AS type
        ,B.value
        FROM tbl_002_question AS A
        INNER JOIN tbl_001_KindOfQuestion AS B
        ON A.kindofquestion = B.id
        WHERE A.id =".$param);
    }

    
}