<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;
use App\Models\Transaksi\Pelanggan;
use App\Models\Master\Periode;
use App\Models\Master\Bendahara;

class CetakpembayaranController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Tagihan;
        $this->primaryKey='tagId';
        $this->mainroute='cetakpembayaran';
        $this->route2='cetakpembayaran';
        $this->mandatory=array(
                                'compId' => 'required',
                                'tagBayar' => 'required',
                              );
        $this->grid=array(
                        array(
                                'label'=>'NAMA',
                                'field'=>'pelNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'BENDAHARA',
                                'field'=>'bendNama',
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
                                'label'=>'KONFIRMASI',
                                'field'=>'tagBayar2',
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
                        array(
                                'label'=>'KETERANGAN',
                                'field'=>'tagKeterangan',
                                'type'=>'text',
                                'width'=>'20%'
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


        $comboStatusBayar[]=(object) array("comboValue"=>"1","comboLabel"=>"Lunas");
        $comboStatusBayar[]=(object) array("comboValue"=>"2","comboLabel"=>"Konfirmasi Bayar");
        $comboStatusBayar[]=(object) array("comboValue"=>"3","comboLabel"=>"Kurang Bayar");

        $this->form=array();
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
            $filterPeriode=!empty($_GET['filterPeriode'])?$_GET['filterPeriode']:'';
            $filterBulan=!empty($_GET['filterBulan'])?$_GET['filterBulan']:'';
            $filterTahun=!empty($_GET['filterTahun'])?$_GET['filterTahun']:'';
            $filterBendahara=!empty($_GET['filterBendahara'])?trim($_GET['filterBendahara']):0;

            $search=trim($filterBendahara.$filterPeriode.$filterBulan.$filterTahun);

            $totalBayar=0;
            $totalKonfirmasi=0;
            $totalSisa=0;
            if($search==''){
                $listdata=$this->model
                            ->latest()
                            ->select('trtagihan.*','periodNama','pelNama','paketNama')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
                            ->where('tagPelanggan','=','%'.$search.'%')
                            ->where('trtagihan.compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(15);                
            }else{
	            
	            $txtbend=$filterBendahara;
	            if($filterBendahara=='' or $filterBendahara==0){
	            	$txtbend ='%';
	            }

                $listdata=$this->model
                            ->select('trtagihan.*','periodNama','pelNama','paketNama','bendNama','trtagihan.tagBayar as tagBayar2')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
                            ->leftjoin('msbendahara','bendId','=','tagBendahara')
                            ->where('tagBendahara','like',$txtbend)
                            ->where('tagPeriode','=',$filterPeriode)
                            ->where('tagBulan','=',$filterBulan)
                            ->where('tagTahun','=',$filterTahun)
                            ->where('trtagihan.compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(2000);                

                $idx=0;
                foreach ($listdata as $key => $val) {
                	$tagBayar=$val->tagBayar;
                	$tagStatus=$val->tagStatus;
                	$tagSisa=$val->tagSisa;
                	$totalSisa = $totalSisa+$tagSisa;
                	if($tagStatus==2){
                		$tagBayar2=$tagBayar;
                		$listdata[$idx]['tagBayar2']=$tagBayar;
                		$listdata[$idx]['tagBayar'] =0;
                		$totalKonfirmasi = $totalKonfirmasi+$tagBayar;
                	}else{
                		$listdata[$idx]['tagBayar2']=0;                		
                		$totalBayar = $totalBayar+$tagBayar;
                	}
                	$idx++;
                }

            }

            $comboPeriode=Periode::get(['periodId as comboValue','periodNama as comboLabel']);
            $comboBendahara=Bendahara::get(['bendId as comboValue','bendNama as comboLabel']);


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
                    'filterBendahara'=>$comboBendahara,
                    'filterPeriode'=>$comboPeriode,
                    'filterBulan'=>$this->filterBulan,
                    'filterTahun'=>$this->filterTahun,
                    'vperiode'=>$filterPeriode,
                    'vbulan'=>$filterBulan,
                    'vtahun'=>$filterTahun,
                    'vbendahara'=>$filterBendahara,
                    'totalBayar'=>$totalBayar,
                    'totalKonfirmasi'=>$totalKonfirmasi,
                    'totalSisa'=>$totalSisa
                    );
            return view('transaksi.cetakbayar',$data)->with('data', $data);
        }
    }



}
