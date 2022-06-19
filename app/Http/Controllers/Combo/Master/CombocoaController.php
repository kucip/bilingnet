<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Master\Coa;

class CombocoaController extends Controllercombo
{

    public function __construct(){
        $this->model=new Coa;
        $this->combodata=array(
                                'id' => 'coaId',
                                'kode' => 'coaKode',
                                'nama' => 'coaNama',
                              );
    }        
}

