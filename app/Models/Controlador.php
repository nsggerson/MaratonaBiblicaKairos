<?php

namespace App\Models;

use Core\BaseModel;
//use Core\BaseModelEloquent;

//class User extends BaseModelEloquent
class Controlador extends BaseModel
{

    //public $table = "users";
    protected $table = "";

    public function panelData(){
       return "SELECT A.id as idPergunta, A.fktype as idTypePergunta, A.fkgrupo as idGrupu,
        B.type as type, A.pergunta as content, A.ponto as pontos,
        C.name as typeGrupo
        FROM `002_perguntas` A
        INNER JOIN `001_typePergunta` B, `005_grupo` C
        ON A.fktype = B.id and A.fkgrupo =  C.id";
    }

    public function parametrosGrupo(){
       return "SELECT   DISTINCT A.fkgrupo AS idGrupo,
       C.name  AS nmGrup
      FROM `007_atividade` A
      INNER JOIN `006_participante` B, `005_grupo` C 
      ON A.fkparticipante = B.id and A.fkgrupo = C.id"; 
    }

    
    public function pontos($param){
        return "SELECT C.id as idGrupo, SUM(B.ponto) as totPont
        FROM `008_ponto`  A 
        INNER JOIN `002_perguntas` B, `005_grupo` C
        ON A.fkpergunta= B.id AND A.fkgrupo = C.id
        WHERE A.fkgrupo= $param";
    }

    public function search($grup,$perg){
        return "SELECT A.id 
        FROM `002_perguntas` A
        INNER JOIN `005_grupo` B
        ON A.fkgrupo = B.id AND B.id = $grup
        WHERE A.id= $perg";
    }

    public function getGrupoid($param){
        return "SELECT  DISTINCT fkgrupo AS id, C.name
        FROM `007_atividade`  A
        INNER JOIN `005_grupo` C
        ON A.fkgrupo= C.id
        WHERE name= '$param'";
    }
    //
    public function getQuestionador($param)
    {
        return "SELECT  A.id AS idPerg, A.fkgrupo AS idGroup, B.name AS nameGroup 
        FROM `002_perguntas` AS A
        INNER JOIN `005_grupo` AS B
        ON A.fkgrupo = B.id
        WHERE B.name= '$param'";        
    }
    
    /**
     * Para buscar o primeiro registro para o input selected
     *
     * @return void
     * Passa parametro para função 
     */
    public function getnameforSelect()
    {
        return "SELECT A.id AS idPerg, A.fkgrupo AS idGroup, B.name AS nameGroup, A.ponto
        FROM `002_perguntas` AS A
        INNER JOIN `005_grupo` AS B
        ON A.fkgrupo = B.id";
    }

    

}