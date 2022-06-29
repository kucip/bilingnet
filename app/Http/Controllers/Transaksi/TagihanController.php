<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;


class TagihanController extends Controllermaster
{

    public function __construct(){        

        $this->model=new Tagihan;
        $this->primaryKey='tagId';
        $this->mainroute='tagihan';
        $this->route2='createtagihan';
        $this->mandatory=array(
                                'compId' => 'required',
                                'tagPelanggan' => 'required',
                              );
        $this->grid=array(
                        array(
                                'label'=>'PERIODE',
                                'field'=>'tagPeriode',
                                'type'=>'text',
                                'width'=>''
                            ),
                     );

        $comboBulan[]=(object) array("comboValue"=>"1","comboLabel"=>"Januari");
        $comboBulan[]=(object) array("comboValue"=>"2","comboLabel"=>"Februari");
        $comboBulan[]=(object) array("comboValue"=>"3","comboLabel"=>"Maret");
        $comboBulan[]=(object) array("comboValue"=>"4","comboLabel"=>"April");
        $comboBulan[]=(object) array("comboValue"=>"5","comboLabel"=>"Mei");
        $comboBulan[]=(object) array("comboValue"=>"6","comboLabel"=>"Juni");
        $comboBulan[]=(object) array("comboValue"=>"7","comboLabel"=>"Juli");
        $comboBulan[]=(object) array("comboValue"=>"8","comboLabel"=>"Agustus");
        $comboBulan[]=(object) array("comboValue"=>"9","comboLabel"=>"September");
        $comboBulan[]=(object) array("comboValue"=>"10","comboLabel"=>"Oktober");
        $comboBulan[]=(object) array("comboValue"=>"11","comboLabel"=>"Novemver");
        $comboBulan[]=(object) array("comboValue"=>"12","comboLabel"=>"Desember");

        for($i=date('Y');$i>=2021;$i--){
	        $comboTahun[]=(object) array("comboValue"=>"$i","comboLabel"=>"$i");
        }

        $this->form=array(
                        array(
                                'label'=>'PERIODE',
                                'field'=>'tagPeriode',
				                'type' => 'autocomplete',
				                'url' =>'comboperiode',
				                'text' => '',
				                'default' => 'Pilih Status',
				                'keterangan' => ''
                            ),
                        array(
                                'label'=>'BULAN',
                                'field'=>'tagBulan',
                                'type'=>'combo',
                                'combodata'=>(object)$comboBulan,
                                'default'=>'Pilih Bulan',
                                'keterangan'=>''
                            ),
                        array(
                                'label'=>'TAHUN',
                                'field'=>'tagTahun',
                                'type'=>'combo',
                                'combodata'=>(object)$comboTahun,
                                'default'=>'Pilih Bulan',
                                'keterangan'=>''
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
	                        ->where('tagPelanggan','like','%'.$search.'%')
                            ->where('compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
	                        ->where('tagPelanggan','like','%'.$search.'%')
                            ->where('compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(15);                
            }

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Pelanggan',
                    'page_active'=> 'Tagihan',
                    'grid'=>$this->grid,
                    'form'=>$this->form,
                    'listdata'=> $listdata,
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'route2' => $this->route2,
                    'compId' => $compId,
                    'code'=>0,
                    'logo'=>$logo,
                    );
            return view('transaksi.tagihan',$data)->with('data', $data);
        }
    }

    public function createTagihan(){    	
    	$periode=$_POST['tagPeriode'];
    	$bulan=$_POST['tagBulan'];
    	$tahun=$_POST['tagTahun'];
    }

}
