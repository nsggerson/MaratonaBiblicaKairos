<?php

namespace Core;


class Event
{


    #   Registra o evento em um Json
    public static function event($param){
        /**
         * Posição 00 start-maratona inicia a estrutura da maratona
         * Posição 01 load-groups Carrega os Grupos
         * Posição 02 start-scoreboard inicia o cronometro
         * Posição 03 stop-scoreboard 
         * Posição 04 end-scoreboard
         * Posição 05 pause-scoreboard
         * Posição 06 start-question
         * Posição 07 start-operando
         * Posição 08 load-scoreboard
         * Posição 09 back-question
         * Posição 10 start-answer
         * Posição 11 return-false
         */
        $name_arquivo = "../storage/repository/json/event.json";
        $array = [
            'start-maratona'
            ,'load-groups'
            ,'start-scoreboard'
            ,'stop-scoreboard'
            ,'end-scoreboard'
            ,'pause-scoreboard'
            ,'start-question'
            ,'start-operando'
            ,'load-scoreboard'
            ,'back-question'
            ,'start-answer'
            ,'return-false'
        ];
        $text = '';
        $a = '';
        if (strlen($param) > 1) {
            $exp = explode(',',$param);
        }else {
            $exp[] = $param; 
        }
        foreach ($exp as $value) {
            if ($a == '') {
                $a = '{"event":["'.$array[$value].'"';
            }else {
                $a = $a.','.'"'.$array[$value].'"';
            }
        }        
        if (!file_exists($name_arquivo)) {
            $text  = $a.']}';
        } else {
            # code...
            unlink($name_arquivo);
            $text  = $a.']}';
        }
        $fp = fopen($name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);
        return $text;        
    }
    
    public static function validateFileJson($i){
        $name=  [ 
            "../storage/repository/json/event.json",
            "../storage/repository/json/showgroups.json",
            "../storage/repository/json/question.json"
        ];
        if (!file_exists($name[$i])){
            return false;  
        }else {
            return true;
        }
    }

    public static function setShowGroups(array $param){

        $name_arquivo = "../storage/repository/json/showgroups.json";
        if (!file_exists($name_arquivo)) {
            
            $text  = json_encode($param, JSON_PRETTY_PRINT);
        } else {
            # code...
            unlink($name_arquivo);
            $text  = json_encode($param, JSON_PRETTY_PRINT);
        }
        $fp = fopen($name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);
        self::event('7,8');
        return $text;
    }

    public static function setQuestion($param){
       
        $name_arquivo = "../storage/repository/json/question.json";
        if (!file_exists($name_arquivo)) {            
            $text  = json_encode($param[0], JSON_PRETTY_PRINT);
        } else {
            # code...
           // $newText  = json_decode(file_get_contents("../storage/repository/json/question.json"));            
            //array_push($newText,$param[0]);            
            unlink($name_arquivo);
            $text  = json_encode($param[0], JSON_PRETTY_PRINT);
        }
        $fp = fopen($name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);       
        return $text;  
    }
}