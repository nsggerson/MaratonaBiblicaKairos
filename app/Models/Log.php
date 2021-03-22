<?php

namespace App\Models;

use Core\BaseModel;
use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class Log extends BaseModel
{

    //public $table = "users";
    protected $table  = "tbl_013_loghystory";
    
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