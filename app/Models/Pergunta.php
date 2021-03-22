<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class Pergunta extends BaseModel
{

    //public $table = "users";
    protected $table = 'tbl_002_question';


    public function positiveBalance($param)
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

}