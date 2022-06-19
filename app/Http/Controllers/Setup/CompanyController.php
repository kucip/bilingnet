<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controllermaster as BaseController;
use Illuminate\Http\Request;
use App\Models\Company;
use Validator;
use Session;
use Input;
use Image;
use File;

class CompanyController extends BaseController
{
    public function __construct()
    {

        $this->model = new Company;
        $this->primaryKey = 'compId';
        $this->mainroute = 'company';
        $this->mandatory = array(
            'compNama' => 'required',
            'compPemilik' => 'required',
            'compLogo' => 'max:1000'
        );

        $this->grid = array(
            array(
                'label' => 'LOGO',
                'field' => 'compLogo',
                'type' => 'image',
                'width' => '20%',
                'class' => 'center'
            ),
            array(
                'label' => 'NAMA',
                'field' => 'compNama',
                'type' => 'text',
                'width' => '30%',
                'class' => ''
            ),
            array(
                'label' => 'PEMILIK',
                'field' => 'compPemilik',
                'type' => 'text',
                'width' => '',
                'class' => ''
            ),
        );
        $this->form = array(
            array(
                'label' => 'NAMA',
                'field' => 'compNama',
                'type' => 'text',
                // 'col'=>6,
                'placeholder' => 'Masukan Nama',
                'keterangan' => 'Wajib Diisi'
            ),
            array(
                'label' => 'PEMILIK',
                'field' => 'compPemilik',
                'type' => 'text',
                // 'col'=>6,
                'placeholder' => 'Masukan Pemilik',
                'keterangan' => 'Wajib Diisi'
            ),
            array(
                'label' => 'LOGO',
                'field' => 'compLogo',
                'type' => 'image',
                // 'col'=>6,
                'placeholder' => '',
                'keterangan' => 'Max 1 Mb'
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
            $logo = Session::get('logo');
            $search = !empty($_GET['search']) ? $_GET['search'] : '';
            if ($search == '') {
                $listdata = $this->model->latest()->paginate(15);
            } else {
                $listdata = $this->model
                    ->where('compNama', 'like', '%' . $search . '%')
                    ->latest()
                    ->paginate(15);
            }
            $compNama = Session::get('compNama');

            $data = array(
                'authmenu' => $this->getusermenu(),
                'company' => $compNama,
                'name' => Session::get('name'),
                'namelong' => Session::get('email'),
                'page_tittle' => 'Setup',
                'page_active' => 'Company',
                'grid' => $this->grid,
                'form' => $this->form,
                'listdata' => $listdata,
                'primaryKey' => $this->primaryKey,
                'mainroute' => $this->mainroute,
                'code' => 0,
                'logo'=>$logo,
            );
            return view('setup.company', $data)->with('data', $data);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->mandatory, [
            'compLogo.max' => 402
        ]); // $this->mainroute

        if ($validator->fails()) {
            $err = $validator->messages();

            if($err->first('compLogo') == '402'){
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 402,
                ];
            }else{
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 401,
                ];
            }
            return response()->json($messages);
        }

        if (method_exists($this, 'beforeStore')) {
            $this->beforeStore($request);
        }
        $img = base64_encode(file_get_contents($request->file('compLogo')));

        $resultdata =  $this->model->create([
            'compNama' => $request->compNama,
            'compPemilik' => $request->compPemilik,
            'compLogo' => 'data:image/png;base64, '.$img.''
        ]);
        // $this->addSysLog($this->model->getTable(), 'create', json_encode($resultdata));
        return $resultdata;
    }

    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), $this->mandatory, [
            'compLogo.max' => 402
        ]);
        if ($validator->fails()) {
            $err = $validator->messages();
            if($err->first('compLogo') == '402'){
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 402,
                ];
            }else{
                $messages = [
                    'data' => $validator->errors(),
                    'status' => 401,
                ];
            }
            return response()->json($messages);
        }

        if ($request->hasFile('compLogo') == true) {

            $img =  $request->file('compLogo');
            $filenames =  $img->getClientOriginalName();
            $img_resize = Image::make($img->getRealPath())->encode('data-url');
            // $img_resize = Image::make($img->getRealPath())->resize(300, 300)->encode('data-url');
            $data = array(
                        'compNama' => $request->compNama,
                        'compPemilik' => $request->compPemilik,
                        'compLogo' => $img_resize->encoded
                    );
        }else{
            $data = array(
                        'compNama' => $request->compNama,
                        'compPemilik' => $request->compPemilik
                    );

        }

        $this->model->find($id)->update($data);

        // $this->addSysLog($this->model->getTable(), 'update', json_encode($data));

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->model->find($id);
        $this->model->find($id)->delete();

        return response()->json('data deleted successfully');
    }
}
