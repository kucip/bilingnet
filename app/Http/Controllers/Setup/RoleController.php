<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Role;
use Session;
use Input;

class RoleController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Role;
        $this->primaryKey = 'roleId';
        $this->mainroute = 'role';
        $this->mandatory = array(
            'compId' => 'required',
            'roleNama' => 'required',
        );

        $this->grid = array(
            array(
                'label' => 'ROLE',
                'field' => 'roleNama',
                'type' => 'text',
                'width' => ''
            ),

        );
        $this->form = array(
            array(
                'label' => 'ROLE',
                'field' => 'roleNama',
                'type' => 'text',
                'placeholder' => 'Masukan Role',
                'keterangan' => 'Wajib Diisi'
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
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata = $this->model
                    ->latest()
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            } else {
                $listdata = $this->model
                    ->where('roleNama', 'like', '%' . $search . '%')
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            }

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => $compNama,
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Master Role',
                'page_active' => 'Master Role',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'compId' => $compId,
                'code' => 0,
            );

            return view('setup.index', $data)->with('data', $data);
        }
    }
}
