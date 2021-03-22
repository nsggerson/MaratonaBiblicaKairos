<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class Questionador extends BaseModel
{

    //public $table = "users";
    protected $table = "tbl_005_groups";

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
                /**/B.id= A.fkgroups 
                AND C.id= A.fkquestion
                AND D.id= C.kindofquestion
            WHERE B.id =  $param";
    }
}
