<?php

namespace Core;

use App\Models\User;

trait Authenticate
{
     
    private $global;
    private $confirm_data;
    private $confirm_senh;
   

    private function Globlas(){
       $this->global = Container::getModel('User'); 
       $this->confirm_data= null;       
       $this->confirm_senh= null;     
    }
    
    public function login()
    {
        
        if(empty($this->auth->check())){
            $this->setPageTitle('Login');       
            return $this->renderView('user/login', 'layout');
        }
        return Redirect::route('/');        
    }
    
    public function auth($request)
    {
        $type= '';
        $login = '';
        $result_database ='';
        $senha = trim($request->post->password);
        strstr($request->post->email,'@')?$type= 'email':$type= 'others';
           
        if ($type == 'email') {
            # code...
            $result_database = $this->global->findParam(['email',$request->post->email]);
            $login = $result_database[0]->email;
        }if ($type == 'others') {           
            $result_database = $this->global->findParam(['registrationNumber',strtoupper($request->post->email)]);
            $login = $result_database[0]->registrationNumber;
        }
        
        if($result_database != ''){            
            $this->confirm_senh = password_verify($senha, $result_database[0]->password);
            $this->confirm_data = $login;            
        }        

        if (!empty($this->confirm_data) && $this->confirm_senh == 1) {
            # Validado a senha
            $user = [
                'id' => $result_database[0]->id,
                'name' => $result_database[0]->name,
                'registrationNumber'=> $result_database[0]->registrationNumber,
                'email' => $result_database[0]->email
            ];           
            
            Session::set('user', $user);
            return Redirect::route('/adm');    
        }
        return Redirect::route('/login', [
            'errors' => ['Usuário ou senha estão incorretos'],
            'inputs' => ['email' => $request->post->email]
        ]);       
    }
    
    public function logout()
    {
        Session::destroy('user');
        return Redirect::route('/login');
    }
}