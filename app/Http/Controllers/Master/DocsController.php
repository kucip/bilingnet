<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Master\Docs;
use Session;

class DocsController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Docs();
        $this->primaryKey = 'did';
        $this->mainroute = 'docs';
        $this->mandatory = array(
            'compId' => 'required',
            'dnama' => 'required',
        );

        $this->grid = array(
            array(
                'label' => 'NAMA',
                'field' => 'dnama',
                'type' => 'text',
                'width' => ''
            ),

        );
        $this->form = array(
            array(
                'label' => 'TEXT',
                'field' => 'dnama',
                'type' => 'text',
                'placeholder' => 'Masukan Role',
                'keterangan' => 'Wajib Diisi'
            ),
            array(
                'label' => 'NILAI',
                'field' => 'roleAngka',
                'type' => 'angka',
                'placeholder' => 'Masukan Nilai',
                'keterangan' => ''
            ),
            array(
                'label' => 'TEXTAREA',
                'field' => 'roleAngkanm',
                'type' => 'textarea',
                'placeholder' => 'Masukan Nilai sdfsf',
                'keterangan' => ''
            ),
            array(
                'label' => 'TANGGAL',
                'field' => 'roleAngkanmsd',
                'type' => 'date',
                'keterangan' => ''
            ),
            array(
                'label' => 'DATETIME',
                'field' => 'roleAngkanmssdd',
                'type' => 'datetime',
                'keterangan' => ''
            ),
            array(
                'label' => 'TIME',
                'field' => 'roleAngkanmsdasd',
                'type' => 'time',
                'keterangan' => ''
            ),
            array(
                'label' => 'COLOR',
                'field' => 'roleAngkanmsdasd',
                'type' => 'color',
                'keterangan' => ''
            ),
            array(
                'label' => 'FILE',
                'field' => 'roleAngkanmsdasd',
                'type' => 'file',
                'keterangan' => ''
            ),
            array(
                'label' => 'AUTO COMPLETE',
                'field' => 'menuParent',
                'type' => 'autocomplete',
                'url' =>'comboparent',
                'text' => 2,
                'default' => 'Pilih Autocomplete',
                'keterangan' => ''
            ),
        );
    }

    public function index()
    {
        if (trim(Session::get('email')) == '' or $this->checkRouteAuth() == 2) {
            $wallidx = rand(1, 7);
            $data = array(
                'wallidx' => $wallidx,
                'message' => 'Anda telah logout dari system.',
            );
            return view('login', $data);
        } else {

            $compId = Session::get('compId');
            $compNama = Session::get('compNama');
            $logo = Session::get('logo');
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata = $this->model
                    ->latest()
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            } else {
                $listdata = $this->model
                    ->where('dnama', 'like', '%' . $search . '%')
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            }

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => $compNama,
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Documentation',
                'page_active' => 'Docs',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
                'logo'=>$logo,
            );

            return view('master.docs', $data)->with('data', $data);
        }
    }
}
