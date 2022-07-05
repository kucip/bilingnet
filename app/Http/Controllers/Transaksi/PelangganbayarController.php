<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;
use App\Models\Transaksi\Pelanggan;
use App\Models\Master\Periode;

class PelangganbayarController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Tagihan;
        $this->primaryKey='tagId';
        $this->mainroute='pelangganbayar';
        $this->route2='pelangganbayarsearch';
        $this->mandatory=array(
                                'compId' => 'required',
                                'tagBayar' => 'required',
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
                        array(
                                'label'=>'PEMBAYARAN',
                                'field'=>'tagBayar',
                                'type'=>'number',
                                'width'=>''
                            ),
                        array(
                                'label'=>'SISA',
                                'field'=>'tagSisa',
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

        $this->filterBulan=$comboBulan;
        $this->filterTahun=$comboTahun;


        $this->form=array(
                        array(
                                'label'=>'NAMA PELANGGAN',
                                'field'=>'tagPelangganNama',
                                'type' => 'text',
                                'placeholder' => 'Nama Pelanggan',
                                'keterangan' => '',
                                'disable'=>'disabled="true"',
                            ),  
                        array(
                                'label'=>'PERIODE',
                                'field'=>'tagPeriode',
                                'type' => 'autocomplete',
                                'url' =>'comboperiode',
                                'text' => '',
                                'default' => 'Periode',
                                'keterangan' => '',
                                'disable'=>'disabled="true"',
                            ),
                        array(
                                'label'=>'BULAN',
                                'field'=>'tagBulan',
                                'type'=>'combo',
                                'combodata'=>(object)$comboBulan,
                                'default'=>'Bulan',
                                'keterangan'=>'',
                                'disable'=>'disabled="true"',
                            ),
                        array(
                                'label'=>'TAHUN',
                                'field'=>'tagTahun',
                                'type'=>'combo',
                                'combodata'=>(object)$comboTahun,
                                'default'=>'Tahun',
                                'keterangan'=>'',
                                'disable'=>'disabled="true"',
                            ),
                        array(
                                'label'=>'TAGIHAN',
                                'field'=>'tagTagihan',
                                'type' => 'number',
                                'placeholder' => 'Tagihan',
                                'keterangan' => 'Jumlah Tagihan',
                                'disable'=>'disabled="true"',
                            ),  
                        array(
                                'label'=>'PEMBAYARAN',
                                'field'=>'tagBayar',
                                'type' => 'number',
                                'placeholder' => 'Pembayaran',
                                'keterangan' => 'Jumlah Yang Dibayarkan',
                                'disable'=>'',
                            ),  
                        array(
                                'label'=>'SISA PEMBAYARAN',
                                'field'=>'tagSisa',
                                'type' => 'number',
                                'placeholder' => 'Sisa Pembayaran',
                                'keterangan' => 'Isikan nilai jika pelanggan kurang bayar',
                                'disable'=>'',
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

            $comboPeriode=Periode::get(['periodId as comboValue','periodNama as comboLabel']);


            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Pelanggan',
                    'page_active'=> 'Pembayaran',
                    'grid'=>$this->grid,
                    'form'=>$this->form,
                    'listdata'=> $listdata,
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'route2' => $this->route2,
                    'compId' => $compId,
                    'code'=>0,
                    'logo'=>$logo,
                    'filterPeriode'=>$comboPeriode,
                    'filterBulan'=>$this->filterBulan,
                    'filterTahun'=>$this->filterTahun,
                    );
            return view('transaksi.bayar',$data)->with('data', $data);
        }
    }

    public function searching(){
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

            $comboPeriode=Periode::get(['periodId as comboValue','periodNama as comboLabel']);


            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Pelanggan',
                    'page_active'=> 'Pembayaran',
                    'grid'=>$this->grid,
                    'form'=>$this->form,
                    'listdata'=> $listdata,
                    'primaryKey'=>$this->primaryKey,
                    'mainroute' => $this->mainroute,
                    'route2' => $this->route2,
                    'compId' => $compId,
                    'code'=>0,
                    'logo'=>$logo,
                    'filterPeriode'=>$comboPeriode,
                    'filterBulan'=>$this->filterBulan,
                    'filterTahun'=>$this->filterTahun,
                    );
            return view('transaksi.bayar',$data)->with('data', $data);
        }
    }

}
