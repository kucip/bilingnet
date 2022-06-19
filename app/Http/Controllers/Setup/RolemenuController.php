<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Rolemenu;
use Session;
use Input;

class RolemenuController extends Controllermaster
{
    public function __construct(){        

        $this->role=Role::all();
        $this->menu=Menu::all();
        $this->model=new Rolemenu;

        $this->primaryKey='rmId';
        $this->mainroute='rolemenu';
        $this->mandatory=array(
                                'compId' => 'required',
                                'rmRoleId' => 'required',
                                'rmMenuId' => 'required',
                              );
    }

    public function index(){

        if(trim(Session::get('email'))=='' or $this->checkRouteAuth()==2){
            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'Anda telah logout dari system.',
                    ); 
            return view('login',$data);        
        }else{

            $compId = Session::get('compId');
            $compNama = Session::get('compNama');

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Role Menu',
                    'page_active'=> 'Role Menu',
                    'role'=> $this->role,
                    'menu'=> $this->menu,
                    'rolemenu'=> $this->model->all(),
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'compId' => $compId,
                    'code'=>0,
                    );
            return view('setup.rolemenu',$data)->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        $datamenu=$request->get('data');    
        $compId = Session::get('compId');
        $roleId=$request->get('roleId');    
        $this->model
                // ->where('compId','=',$compId)
                ->where('rmRoleId','=',$roleId)
                ->delete();

        foreach($datamenu as $val){
            $result = Rolemenu::create([
                'compId' => $compId,
                'rmRoleId' => $roleId,
                'rmMenuId' => $val,
             ]);
        }

        return $request->get('roleId');

    }


}
