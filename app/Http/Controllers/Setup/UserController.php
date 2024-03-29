<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use Session;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;

class UserController extends Controllermaster
{
    public function __construct(){        

        $this->model=new User;
        $this->primaryKey='id';
        $this->mainroute='user';

        $comboCompany=Company::get(['compId as comboValue','compNama as comboLabel']);
        
        $this->mandatory=array(
                                'name' => 'required',
                                'compId' => 'required',
                                'email' => 'required',
                                'password' => 'required',
                                'role' => 'required',
                              );

        $this->grid=array(
                        array(
                                'label'=>'USER',
                                'field'=>'name',
                                'type'=>'text',
                                'width'=>'15%'
                            ),
                        array(
                                'label'=>'EMAIL',
                                'field'=>'email',
                                'type'=>'text',
                                'width'=>'25%'
                            ),
                        array(
                                'label'=>'COMPANY',
                                'field'=>'compNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'ROLE',
                                'field'=>'roleNama',
                                'type'=>'text',
                                'width'=>'25%'
                            ),
                     );
        $this->form=array(
                        array(
                                'label'=>'USER',
                                'field'=>'name',
                                'type'=>'text',
                                'placeholder'=>'Masukan User',
                                'keterangan'=>'Wajib Diisi'
                            ),
                        array(
                                'label'=>'EMAIL',
                                'field'=>'email',
                                'type'=>'text',
                                'placeholder'=>'Masukan Email',
                                'keterangan'=>'Wajib Diisi'
                            ),
                        array(
                                'label'=>'PASSWORD',
                                'field'=>'password',
                                'type'=>'password',
                                'placeholder'=>'Masukan Password',
                                'keterangan'=>'Wajib Diisi'
                            ),
                        array(
                                'label'=>'COMPANY',
                                'field'=>'compId',
                                'type'=>'combo',
                                'combodata'=>$comboCompany,
                                'default'=>'Pilih Company',
                                'keterangan'=>'Wajib Diisi'
                            ),
                        array(
                                'label' => 'ROLE',
                                'field' => 'role',
                                'type' => 'autocomplete',
                                'url' =>'comborole',
                                'text' => 2,
                                'default' => 'Pilih Role',
                                'keterangan' => 'Wajib Diisi'
                            ),
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

            $logo = Session::get('logo');
            $search=!empty($_GET['search'])?$_GET['search']:'';
            if($search==''){
                $listdata=$this->model
                            ->select('id','name','email','password','mscompany.compId','compNama','role','roleNama')
                            ->leftjoin('mscompany','mscompany.compId','=','users.compId')
                            ->leftjoin('role','role.roleId','=','users.role')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                          ->select('id','name','email','password','mscompany.compId','compNama','role','roleNama')
                          ->leftjoin('mscompany','mscompany.compId','=','users.compId')
                          ->leftjoin('role','role.roleId','=','users.role')
                          ->where('name','like','%'.$search.'%')
                          ->paginate(15);                
            }
            $compNama = Session::get('compNama');

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Setup',
                    'page_active'=> 'User',
                    'grid'=>$this->grid,
                    'form'=>$this->form,
                    'listdata'=> $listdata,
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'code'=>0,
                    'logo'=>$logo,
                    );
            return view('setup.user',$data)->with('data', $data);
        }
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if($validator->fails()){
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'compId' => $request->compId,
            'role' => $request->role,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json('user saved');

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),$this->mandatory);
        if($validator->fails()){
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }        

        $data=array(
                        'name' => $request->name,
                        'email' => $request->email,
                        'compId' => $request->compId,
                        'role' => $request->role,
                        'password' => Hash::make($request->password)            
                     );

        // $data=$request->all();

        $this->model->find($id)->update($data);
        return $data;
    }



}
