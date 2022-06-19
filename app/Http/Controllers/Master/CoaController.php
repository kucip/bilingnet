<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Coa;
use Session;
use Input;

class CoaController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Coa;
        $this->primaryKey='coaId';
        $this->mainroute='coa';
        $this->mandatory=array(
                                'compId' => 'required',
                                'coaKode' => 'required',
                                'coaNama' => 'required',
                              );

        $this->grid=array(
                        array(
                                'label'=>'KODE',
                                'field'=>'coaKode',
                                'type'=>'text',
                                'width'=>'20%'
                            ),
                        array(
                                'label'=>'NAMA',
                                'field'=>'coaNama',
                                'type'=>'text',
                                'width'=>''
                            ),

                     );
        $this->form=array(
                        array(
                                'label'=>'KODE',
                                'field'=>'coaKode',
                                'type'=>'text',
                                'placeholder'=>'Masukan Kode',
                                'keterangan'=>'Kode Wajib Diisi'
                            ),
                        array(
                                'label'=>'NAMA',
                                'field'=>'coaNama',
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
                            ->orderby('coaKode','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                          ->where('coaNama','like','%'.$search.'%')
                          ->orwhere('coaKode','like','%'.$search.'%')
                          ->where('compId','=',$compId)
                          ->orderby('coaKode','asc')
                          ->paginate(15);                
            }

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Master',
                    'page_active'=> 'Coa',
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
