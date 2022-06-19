<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Statusaktif;
use Session;
use Input;

class StatusaktifController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Statusaktif;
        $this->primaryKey='statId';
        $this->mainroute='statusaktif';
        $this->mandatory=array(
                                'compId' => 'required',
                                'statNama' => 'required',
                              );

        $this->grid=array(
                        array(
                                'label'=>'NAMA',
                                'field'=>'statNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                     );
        $this->form=array(
                        array(
                                'label'=>'NAMA',
                                'field'=>'statNama',
                                'type'=>'text',
                                'placeholder'=>'Masukan Nama',
                                'keterangan'=>'Nama Wajib Diisi'
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

            $compId = Session::get('compId');
            $compNama = Session::get('compNama');
            $logo = Session::get('logo');
            $search=!empty($_GET['search'])?$_GET['search']:'';
            if($search==''){
                $listdata=$this->model
                            ->latest()
                            ->where('compId','=',$compId)
                            ->orderby('statId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                          ->where('statNama','like','%'.$search.'%')
                          ->where('compId','=',$compId)
                          ->orderby('statId','asc')
                          ->paginate(15);                
            }

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Master',
                    'page_active'=> 'Status Aktif',
                    'grid'=>$this->grid,
                    'form'=>$this->form,
                    'listdata'=> $listdata,
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'compId' => $compId,
                    'code'=>0,
                    'logo'=>$logo,
                    );
            return view('master.index',$data)->with('data', $data);
        }
    }
}
