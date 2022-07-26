<?php

namespace App\Http\Controllers\Ipaymu;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Transaksi\Tagihan;
use Session;
use Input;

class PayupdateController extends Controllermaster
{

    public function __construct(){        
        $this->model=new Tagihan;
        $this->primaryKey='tagId';
    }

    public function updatepay(Request $request){

        // $trx_id       =$_POST['trx_id'];
        // $status       =$_POST['status'];
        // $status_code  =$_POST['status_code'];
        // $sid          =$_POST['sid'];
        // $reference_id =$_POST['reference_id'];

        $trx_id       =$request->trx_id;
        $status       =$request->status;
        $status_code  =$request->status_code;
        $sid          =$request->sid;
        $reference_id =$request->reference_id;

        $data=array(
                        "payStatus"=>$status,
                        "payStatusCode"=>$status_code,
                        "paySid"=>$sid,
                        "payRefId"=>$reference_id,
                   );

        $this->model->update($data)->where('payTransId','=',$trx_id);
        return 1;

    }
}
