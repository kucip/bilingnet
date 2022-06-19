<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use Session;

class MainController extends Controllermaster
{
    public function index(){
        if(trim(Session::get('email'))==''){

            $wallidx=rand(1,7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            ); 
            return view('login',$data);        
        }else{
                $name = Session::get('name');
                $email = Session::get('email');
                $compNama = Session::get('compNama');
                $logo = Session::get('logo');

                $data = array(
                        'authmenu'=>$this->getusermenu(),
                        'company' =>$compNama,
                        'name' => $name,
                        'namelong' => $email,
                        'tittle'=>'Home',
                        'page_tittle'=> 'Home',
                        'page_active'=>'Home',
                        'logo'=>$logo,
                        );

                return view('home',$data)->with('data', $data);
        }
    }
}
