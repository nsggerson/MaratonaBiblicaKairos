<?php

namespace App\Models;

use Core\BaseModel;


#class Paciente extends BaseModelEloquent
class Resposta extends BaseModel
{
    protected $table = "tbl_014_answer";


    public function getTheAnswer($param){
        return ("SELECT 
                A.id
                ,C.text
                ,C.title AS type 
                ,B.value
        FROM tbl_002_question AS A
        INNER JOIN tbl_001_KindOfQuestion AS B, tbl_014_answer AS C
        ON A.kindofquestion= B.id AND C.id = A.id
        WHERE A.id =".$param);
    }

}