<?php

namespace App\Http\Controllers\Ipaymu;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;
use App\Models\Transaksi\Pelanggan;
use App\Models\Master\Periode;

class PostingController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Tagihan;
        $this->primaryKey='tagId';
        $this->mainroute='postingtagihan';
        $this->route2='postingtagihansearch';
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
                                'label'=>'TAGIHAN',
                                'field'=>'tagTagihan',
                                'type'=>'number',
                                'width'=>''
                            ),
                        array(
                                'label'=>'STATUS',
                                'field'=>'trStatus',
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

        $this->filterBulan=$comboBulan;
        $this->filterTahun=$comboTahun;


        $comboStatusBayar[]=(object) array("comboValue"=>"1","comboLabel"=>"Lunas");
        $comboStatusBayar[]=(object) array("comboValue"=>"2","comboLabel"=>"Konfirmasi Bayar");
        $comboStatusBayar[]=(object) array("comboValue"=>"3","comboLabel"=>"Kurang Bayar");


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
                                'label'=>'NOHP',
                                'field'=>'pelNoHp',
                                'type' => 'hidden',
                                'placeholder' => '',
                                'keterangan' => '',
                                'disable'=>'disabled="true"',
                            ),  
                        array(
                                'label'=>'KETERANGAN',
                                'field'=>'tagKeterangan',
                                'type' => 'text',
                                'placeholder' => 'Keterangan',
                                'keterangan' => '',
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
            $keyword=!empty($_GET['search'])?$_GET['search']:'';
            $filterPeriode=!empty($_GET['filterPeriode'])?$_GET['filterPeriode']:'';
            $filterBulan=!empty($_GET['filterBulan'])?$_GET['filterBulan']:'';
            $filterTahun=!empty($_GET['filterTahun'])?$_GET['filterTahun']:'';
            
            $search=trim($keyword.$filterPeriode.$filterBulan.$filterTahun);

            if($search==''){
                $listdata=$this->model
                            ->latest()
                            ->select('trtagihan.*','periodNama','pelNama','pelNoHp','paketNama')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
                            ->where('tagPelanggan','like','%'.$search.'%')
                            ->where('trtagihan.compId','=',$compId)
                            ->orderby('tagId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
                            ->select('trtagihan.*','periodNama','pelNoHp','pelNama','paketNama')                            
                            ->leftjoin('msperiode','periodId','=','tagPeriode')
                            ->leftjoin('mspaket','paketId','=','tagPaket')
                            ->leftjoin('mspelanggan','pelId','=','tagPelanggan')
                            ->where('tagPelangganNama','like','%'.$keyword.'%')
                            ->where('tagPeriode','=',$filterPeriode)
                            ->where('tagBulan','=',$filterBulan)
                            ->where('tagTahun','=',$filterTahun)
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
                    'vkeyword'=>$keyword,
                    'vperiode'=>$filterPeriode,
                    'vbulan'=>$filterBulan,
                    'vtahun'=>$filterTahun
                    );
            return view('posting.index',$data)->with('data', $data);
        }
    }


    public function update(Request $request, $id){
        // return $request;


        $va           = '0000005234729998'; //get on iPaymu dashboard
        $secret       = 'SANDBOXB4CEEAE0-BADE-4EC1-B900-9FF754400CFA-20220227125606'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; //url
        $method       = 'POST'; //method


        $body = array(
                "name"=>$request->tagPelangganNama,
                "phone"=>$request->pelNoHp,
                "email"=>"",
                "amount"=>$request->tagTagihan,
                "notifyUrl"=>"http://biling-wifi.optimasolution.co.id/payupdate",
                "expired"=>"24",
                "expiredType"=>"hours",
                "comments"=>$request->tagKeterangan,
                "referenceId"=>"1",
                "paymentMethod"=>"va",
                "paymentChannel"=>"bca",
                "product"=>array(),
                "qty"=>array(),
                "price"=>array(),
                "weight"=>array(),
                "width"=>array(),
                "height"=>array(),
                "length"=>array(),
                "deliveryArea"=>"",
                "deliveryAddress"=>""
            );



        //Generate Signature
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $ch = curl_init($url);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $ret;

    }


}
