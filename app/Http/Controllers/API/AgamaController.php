<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use Validator;
use App\Models\Agama;
use App\Http\Resources\AgamaResource;

class AgamaController extends Controllermaster
{

    public function __construct(){
        $this->model=new Agama;
        $this->resources=new AgamaResource(null);
        $this->mandatory=array(
                                'compId' => 'required',
                                'agamaNama' => 'required'
                              );
    }

}