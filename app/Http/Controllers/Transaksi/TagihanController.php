<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;
use App\Models\Transaksi\Pelanggan;


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
                                'field'=>'periodNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'BULAN',
                                'field'=>'tagBulanNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'TAHUN',
                                'field'=>'tagTahun',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'NAMA',
                                'field'=>'pelNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'PAKET',
                                'field'=>'paketNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'TAGIHAN',
                                'field'=>'tagTagihan',
                                'type'=>'number',
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
                            ->select('trtagihan.*','periodNama','pelNama','paketNama')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
	                        ->where('tagPelanggan','like','%'.$search.'%')
                            ->where('trtagihan.compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                            ->select('trtagihan.*','periodNama','pelNama','paketNama')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
	                        ->where('tagPelanggan','like','%'.$search.'%')
                            ->where('trtagihan.compId','=',$compId)
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

        $compId = Session::get('compId');

    	$periode=$_POST['tagPeriode'];
    	$bulan=$_POST['tagBulan'];
    	$tahun=$_POST['tagTahun'];
        $pelanggan=new Pelanggan;
        $datapelanggan=$pelanggan
                        ->select('mspelanggan.*','paketHarga')
                        ->leftjoin('mspaket','paketId','=','pelPaket')
                        ->where('pelPeriodeBayar','=',$periode)
                        ->latest()
                        ->get();

        foreach ($datapelanggan as $key => $val) {
            $pelId=$val->pelId;
            $pelNama=$val->pelNama;
            $pelUserId=$val->pelUserId;
            $pelPaket=$val->pelPaket;
            $pelAktif=$val->pelAktif;
            $pelTagihan=$val->paketHarga;

            if($this->cekTagihan($periode,$bulan,$tahun,$pelId)==0){
                $data= new Tagihan;
                $data->compId = $compId;
                $data->tagPeriode = $periode;
                $data->tagBulan = $bulan;
                $data->tagBulanNama = $this->namaBulan($bulan);
                $data->tagTahun = $tahun;
                $data->tagPelanggan = $pelId;
                $data->tagPaket = $pelPaket;
                $data->tagTagihan = $pelTagihan;
                $data->save();
            }
        }

        return array("status"=>200);

    }

    public function cekTagihan($periode,$bulan,$tahun,$idpel){

        $cektag=$this->model
                        ->where('tagPeriode','=',$periode)
                        ->where('tagBulan','=',$bulan)
                        ->where('tagTahun','=',$tahun)
                        ->where('tagPelanggan','=',$idpel)
                        ->get();
        if(count($cektag)>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function namaBulan($val){
        if($val==1){
            $txt='Januari';
        }elseif($val==2){
            $txt='Februari';
        }elseif($val==3){
            $txt='Maret';
        }elseif($val==4){
            $txt='April';
        }elseif($val==5){
            $txt='Mei';
        }elseif($val==6){
            $txt='Juni';
        }elseif($val==7){
            $txt='Juli';
        }elseif($val==8){
            $txt='Agustus';
        }elseif($val==9){
            $txt='September';
        }elseif($val==10){
            $txt='Oktober';
        }elseif($val==11){
            $txt='Novemver';
        }elseif($val==12){
            $txt='Desember';
        }
        return $txt;
    }
}
