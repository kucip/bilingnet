<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Pelanggan;
use Session;
use Input;

class PelangganController extends Controllermaster
{
    public function __construct(){        

        $this->model=new Pelanggan;
        $this->primaryKey='pelId';
        $this->mainroute='datapelanggan';
        $this->mandatory=array(
                                'compId' => 'required',
                                'pelNama' => 'required',
                              );

        $this->grid=array(
                        array(
                                'label'=>'NAMA',
                                'field'=>'pelNama',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'USER',
                                'field'=>'pelUserId',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'NOMOR HP',
                                'field'=>'pelNoHp',
                                'type'=>'text',
                                'width'=>''
                            ),
                        array(
                                'label'=>'PERIODE',
                                'field'=>'periodNama',
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
                                'label'=>'HARGA',
                                'field'=>'paketHarga',
                                'type'=>'number',
                                'width'=>''
                            ),
                        array(
                                'label'=>'STATUS',
                                'field'=>'statNama',
                                'type'=>'text',
                                'width'=>''
                            ),

                     );
        $this->form=array(
                        array(
                                'label'=>'NAMA',
                                'field'=>'pelNama',
                                'type'=>'text',
                                'placeholder'=>'Masukan Nama',
                                'keterangan'=>'Nama Wajib Diisi'
                            ),
                        array(
                                'label'=>'USER',
                                'field'=>'pelUserId',
                                'type'=>'text',
                                'placeholder'=>'Masukan User Id',
                                'keterangan'=>'User Wajib Diisi'
                            ),
                        array(
                                'label'=>'ALAMAT',
                                'field'=>'pelAlamat',
                                'type'=>'text',
                                'placeholder'=>'Masukan Alamat',
                                'keterangan'=>'Alamat Wajib Diisi'
                            ),
                        array(
                                'label'=>'NOMOR HP',
                                'field'=>'pelNoHp',
                                'type'=>'text',
                                'placeholder'=>'Masukan Nomor HP',
                                'keterangan'=>'Nomor HP Wajib Diisi'
                            ),
                        array(
                                'label'=>'PERIODE BAYAR',
                                'field'=>'pelPeriodeBayar',
				                'type' => 'autocomplete',
				                'url' =>'comboperiode',
				                'text' => '',
				                'default' => 'Pilih Periode',
				                'keterangan' => ''
                            ),
                        array(
                                'label'=>'PAKET',
                                'field'=>'pelPaket',
				                'type' => 'autocomplete',
				                'url' =>'combopaket',
				                'text' => '',
				                'default' => 'Pilih Paket',
				                'keterangan' => ''
                            ),
                        array(
                                'label'=>'STATUS PEMAKAIAN',
                                'field'=>'pelAktif',
				                'type' => 'autocomplete',
				                'url' =>'combostatus',
				                'text' => '',
				                'default' => 'Pilih Status',
				                'keterangan' => ''
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
                			->select('mspelanggan.*','periodNama','paketNama','paketHarga','statNama')
                            ->latest()
                            ->leftjoin('msperiode','periodId','=','pelPeriodeBayar')
                            ->leftjoin('mspaket','paketId','=','pelPaket')
                            ->leftjoin('msstatus','statId','=','pelAktif')
                            ->where('mspelanggan.compId','=',$compId)
                            ->orderby('pelId','asc')
                            ->paginate(15);
            }else{
                $listdata=$this->model
            			  ->select('mspelanggan.*','periodNama','paketNama','paketHarga','statNama')
                          ->leftjoin('msperiode','periodId','=','pelPeriodeBayar')
                          ->leftjoin('mspaket','paketId','=','pelPaket')
                          ->leftjoin('msstatus','statId','=','pelAktif')
                          ->where('pelNama','like','%'.$search.'%')
                          ->where('mspelanggan.compId','=',$compId)
                          ->orderby('pelId','asc')
                          ->paginate(15);                
            }

            $data = array(
                    'authmenu'=>$this->getusermenu(),
                    'company' =>$compNama,
                    'name' => Session::get('name'),
                    'namelong' => Session::get('email'),
                    'page_tittle'=> 'Pelanggan',
                    'page_active'=> 'Data Pelanggan',
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
