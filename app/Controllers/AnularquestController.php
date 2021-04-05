<?php

namespace App\Controllers;

use Core\Authenticate;
use Core\BaseController;
use Core\Container;
use Dotenv\Regex\Result;

class AnularquestController extends BaseController
{
    use Authenticate;

    private $global;


    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("Anularquest");
    }

    public function index()
    {
        $data = [];
        foreach ($this->global->All() as $value) {
            $data[] = [
                "id" => $value->id
            ];
        }
        return print_r(json_encode($data, JSON_PRETTY_PRINT));
    }

    public function store($id)
    {
        $data = [
            'id' => $id,
            'text'=> 'Teste'
        ];
        return $this->global->create($data);
    }

    public function show($id){
       if (!empty($this->global->find($id))) {
           # code...
            return print_r(true);
       }
       return print_r(false);
    }

    public function delete($id){
        $this->global->delete($id);
        return print_r(true);
    }
}
