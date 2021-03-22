<?php

namespace Core;

use DateTime;

trait DataHora{

    static function data(){
        date_default_timezone_set('America/Sao_Paulo');
        $dd = date('d');
        $mm = date('m');
        $yy = date('yy');
        $hh = date('G:i:s');        
        return [$dd,$mm,$yy,$hh];
    }

    static function arrayMes(){
        $arrayMes = [];
        $arrayMes[1] = 'Janeiro';
        $arrayMes[2] = 'Fevereiro';
        $arrayMes[3] = 'Março';
        $arrayMes[4] = 'Abril';
        $arrayMes[5] = 'Maio';
        $arrayMes[6] = 'Junho';
        $arrayMes[7] = 'Julho';
        $arrayMes[8] = 'Agosto';
        $arrayMes[9] = 'Setembro';
        $arrayMes[10] = 'Outubro';
        $arrayMes[11] = 'Novembro';
        $arrayMes[12] = 'Dezembro';
        return $arrayMes;
    }
        
}