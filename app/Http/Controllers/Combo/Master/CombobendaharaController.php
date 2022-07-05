<?php

namespace App\Http\Controllers\Combo\Master;

use App\Http\Controllers\Controllercombo;
use App\Models\Master\Bendahara;

class CombobendaharaController extends Controllercombo
{
    public function __construct(){
        $this->model=new Bendahara;
        $this->combodata=array(
                                'id' => 'bendId',
                                'kode' => 'bendId',
                                'nama' => 'bendNama',
                              );
    }        
}
