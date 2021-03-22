<?php


trait BaseModelScript{
    private $baseModelScrit;
    static function scriptModel($request){
        print_r($request);
    }

}