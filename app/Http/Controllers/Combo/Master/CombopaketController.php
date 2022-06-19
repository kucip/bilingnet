<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Master\Paket;

class CombopaketController extends Controllercombo
{
    public function __construct(){
        $this->model=new Paket;
        $this->combodata=array(
                                'id' => 'paketId',
                                'kode' => 'paketId',
                                'nama' => 'paketNama',
                              );
    }        
}
