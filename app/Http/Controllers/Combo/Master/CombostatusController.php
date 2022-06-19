<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Master\Statusaktif;

class CombostatusController extends Controllercombo
{
    public function __construct(){
        $this->model=new Statusaktif;
        $this->combodata=array(
                                'id' => 'statId',
                                'kode' => 'statId',
                                'nama' => 'statNama',
                              );
    }        
}
