<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Master\Periode;

class ComboperiodeController extends Controllercombo
{
    public function __construct(){
        $this->model=new Periode;
        $this->combodata=array(
                                'id' => 'periodId',
                                'kode' => 'periodId',
                                'nama' => 'periodNama',
                              );
    }        
}
