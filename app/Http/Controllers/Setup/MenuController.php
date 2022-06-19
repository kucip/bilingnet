<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controllermaster;
use Illuminate\Http\Request;
use App\Models\Menu;
use Session;
use Input;

class MenuController extends Controllermaster
{
    public function __construct()
    {

        $this->model = new Menu;
        $this->primaryKey = 'menuId';
        $this->mainroute = 'menu';
        $this->mandatory = array(
            'compId' => 'required',
            'menuNama' => 'required',
            'menuOrder' => 'required',
        );

        $this->grid = array(
            array(
                'label' => 'MENU',
                'field' => 'menuNama',
                'type' => 'text',
                'width' => ''
            ),
            array(
                'label' => 'ROUTE',
                'field' => 'menuRoute',
                'type' => 'text',
                'width' => ''
            ),
            array(
                'label' => 'ORDER',
                'field' => 'menuOrder',
                'type' => 'text',
                'width' => '7%'
            ),
            array(
                'label' => 'ICON',
                'field' => 'menuIcon',
                'type' => 'text',
                'width' => ''
            ),
        );



        $this->form = array(
            array(
                'label' => 'MENU',
                'field' => 'menuNama',
                'type' => 'text',
                'placeholder' => 'Masukan Menu',
                'keterangan' => 'Wajib Diisi'
            ),
            array(
                'label' => 'ROUTE',
                'field' => 'menuRoute',
                'type' => 'text',
                'placeholder' => 'Masukan Route',
                'keterangan' => ''
            ),
            array(
                'label' => 'ICON',
                'field' => 'menuIcon',
                'type' => 'text',
                'placeholder' => 'Masukan Icon',
                'keterangan' => ''
            ),
            array(
                'label' => 'ORDER',
                'field' => 'menuOrder',
                'type' => 'number',
                'placeholder' => 'Masukan Order',
                'keterangan' => 'Wajib Diisi'
            ),
            array(
                'label' => 'PARENT',
                'field' => 'menuParent',
                'type' => 'autocomplete',
                'url' =>'comboparent',
                'text' => 2,
                'default' => 'Pilih Parent',
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
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata = $this->model
                    ->latest()
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            } else {
                $listdata = $this->model
                    ->where('menuNama', 'like', '%' . $search . '%')
                    ->where('compId', '=', $compId)
                    ->paginate(15);
            }

            $data = array(
                'company' => $compNama,
                'authmenu' => $this->getusermenu(),
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Master Menu',
                'page_active' => 'Master Menu',
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
