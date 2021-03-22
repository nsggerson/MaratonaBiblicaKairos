<?php

namespace Core;


trait Logsjson
{
    private $name_arquivo;
    private $name_dir;
    private $name_method;

    private function def_name($x, $y)
    {
        /**
         * $y valor passado
         * $x nome da tabela
         */


        if ($y < 10) {
            # code...
            $this->name_arquivo = "../storage/repository/json/" . $x . '00' . $y . ".php";
            $this->name_dir = "/../storage/repository/json/" . $x . '00' . $y . ".php";
        } else {
            $this->name_dir = "/../storage/repository/json/" . $x . '0' . $y . ".php";
            $this->name_arquivo = "../storage/repository/json/" . $x . '0' . $y . ".php";
        }
        return;
    }

    public function create_file_json(array $param)
    {
        $array_param = $this->def_parameters($param);
        //$first_key = $array_param[0];
        $first_value = $array_param[1];
        $second_key = $array_param[2];
        $second_value = $array_param[3];
        $this->def_name($first_value, $second_value);
        if (file_exists($this->name_arquivo)) {
            $data = require_once __DIR__ . $this->name_dir;
            if ((string)$data[$second_key] == (string)$second_value) {
                $this->def_method($first_value, $second_value);
                //json_encode((object)$data, JSON_PRETTY_PRINT);
            }
        } else {
            $this->create_json($first_value, $second_value);
        }
        $this->call_queue_layout($this->name_arquivo);
    }

    public function loadQuestion()
    {       
        try {
            if (file_exists('../storage/repository/json/call.php')) {
                $c = require_once __DIR__ . "/../storage/repository/json/call.php";
                $question = require_once __DIR__ . "/../storage/repository/json/" . end($c) . ".php";
                return json_encode((object)$question, JSON_PRETTY_PRINT);
            }
            return json_encode((object)['type'=>'error','description'=>'File not found'], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return json_encode((object)['mess'=>'error','type'=> $e], JSON_PRETTY_PRINT);
        }
    }


    private function call_queue_layout($param)
    {
        $name_arquivo = "../storage/repository/json/call.php";
        $a = explode('/', $param);
        $b = explode('.', $a[4]);
        $d = null;
        if (!file_exists($name_arquivo)) {
            $text  = "<?php return array('" . $b[0] . "');";
        } else {
            $c = require_once __DIR__ . "/../storage/repository/json/call.php";
            unlink($name_arquivo);
            foreach ($c as  $value) {
                if ($d == null) {
                    $d = "'" . $value . "'";
                } else {
                    $d = $d . ",'" . $value . "'";
                }
            }

            $text  = "<?php return array(" . $d . ",'" . $b[0] . "');";
        }
        $fp = fopen($name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);
        print_r(require_once __DIR__ . "/../storage/repository/json/call.php");
        return;
    }

    private function def_parameters(array $param)
    {
        $array_key = [];
        $array_value = [];
        foreach ($param as $key => $value) {
            array_push($array_key, $key);
            array_push($array_value, $value);
        }
        return [$array_key[0], $array_value[0], $array_key[1], $array_value[1]];
    }

    private function def_method($x, $y)
    {
        $name_arquivo = '../storage/repository/json/mothod_' . $x . '.php';
        if (file_exists($name_arquivo)) {
            unlink($name_arquivo);
        }
        $text  = '<?php return $this->global->question(' . $y . ');';
        $fp = fopen($name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);
        return require_once __DIR__ . '/../storage/repository/json/mothod_' . $x . '.php';
    }

    private function create_json($y, $x)
    {
        $text = '';
        $a =  $this->def_method($y, $x);
        foreach ($a as $array) {
            foreach ($array as $key => $value) {
                # code...
                if (ctype_digit($value)) {
                    # code...
                    $text = $text . '"' . $key . '"' . ' => ' .  $value . ',';
                } else {
                    $text = $text . '"' . $key . '"' . ' => ' . '"' . $value . '",';
                }
            }
        }
        $text  = '<?php return array(' . $text . ');';
        # code...
        $fp = fopen($this->name_arquivo, "a+");
        fwrite($fp, $text);
        fclose($fp);
        //echo 'Novo arquivo'; 
        $data = require_once __DIR__ . $this->name_dir;
        //return json_encode((object)$data, JSON_PRETTY_PRINT);
        return;
    }
}
