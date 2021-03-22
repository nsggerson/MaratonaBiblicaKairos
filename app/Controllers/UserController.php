<?php

namespace App\Controllers;

use App\Models\User;
use Core\BaseController;

use Core\Redirect;
use Core\Validator;
use Core\Authenticate;
use Core\Container;

class UserController extends BaseController
{
    use Authenticate;
    private $global;
    //private $user;
    /*
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }
    */
    public function __construct()
    {
        parent::__construct();
        $this->global = Container::getModel("User");
    }


    public function create()
    {

        $this->setPageTitle('New User');
        return $this->renderView('user/create', 'layout');
    }

    public function store($request)
    {
        $data = [
            'name' => $request->post->name,
            'registrationNumber' => $request->post->registrationNumber,
            'email' => $request->post->email,
            'password' => $request->post->password,
            'currentDateAndTime' => $request->post->dateNow
        ];
        
        if(Validator::make($data, $this->user->rulesCreate())){
            return Redirect::route('/user/create');
        }

        $data['password'] = password_hash($request->post->password, PASSWORD_BCRYPT);

        try{
            $this->user->create($data);
            return Redirect::route('/', [
                'success' => ['Usuário criado com sucesso!']
            ]);
        }catch(\Exception $e){
            return Redirect::route('/', [
                'errors' => [$e->getMessage()]
            ]);
        }
        
    }

}