<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Bendahara;
use Session;

class BendaharaController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Bendahara;        
        $this->primaryKey='bendId';
        $this->mainroute='bendahara';
        $this->mandatory=array(
                                'compId' => 'required',
                                'bendNama' => 'required',
                              );

        $this->grid=array(
                        array(
                                'label'=>'BENDAHARA',
                                'field'=>'bendNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                     );

        $this->form=array(
                        array(
                                'label'=>'BENDAHARA',
                                'field'=>'bendNama',
                                'type'=>'text',
                                'placeholder'=>'Masukan Kode',
                                'keterangan'=>'Bendahara Wajib Diisi'
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
                            ->orderby('bendId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                          ->where('bendNama','like','%'.$search.'%')
                          ->where('compId','=',$compId)
                          ->orderby('periodId','asc')
                          ->paginate(15);                
            }

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Master',
                    'page_active'=> 'Bendahara',
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
