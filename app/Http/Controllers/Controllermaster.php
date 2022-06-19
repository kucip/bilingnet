<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rolemenu;
use App\Models\Menu;
use App\Models\Syslog;
use Illuminate\Support\Facades\Route;

class Controllermaster extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $data = $this->model->latest()->get();
        return response()->json([$this->resources->collection($data)]);
    }
    public function show($id)
    {
        $showdata = $this->model->find($id);
        if (is_null($showdata)) {
            return response()->json('data not found', 404);
        }
        return response()->json([new $this->resources($showdata)]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->mandatory); // $this->mainroute

        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        if (method_exists($this, 'beforeStore')) {
            $this->beforeStore($request);
        }
        $resultdata =  $this->model->create($request->all());
        $this->addSysLog($this->model->getTable(), 'create', json_encode($resultdata));
        return $resultdata;
        // return response()->json([new  $this->resources($resultdata)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->mandatory);
        if ($validator->fails()) {
            $messages = [
                'data' => $validator->errors(),
                'status' => 401,
            ];
            return response()->json($messages);
        }

        if (method_exists($this, 'beforeUpdate')) {
            $this->beforeUpdate($request, $id);
        }

        $data = $request->all();

        $this->model->find($id)->update($data);

        $this->addSysLog($this->model->getTable(), 'update', json_encode($data));

        return $data;
        // return response()->json([new $this->resources($data)]);
    }

    public function destroy(Request $request, $id)
    {
        $data = $this->model->find($id);
        $this->model->find($id)->delete();

        $this->addSysLog($this->model->getTable(), 'delete', json_encode($data));
        return response()->json('data deleted successfully');
    }

    public function getusermenu()
    {

        $compId = Session::get('compId');
        $role = Session::get('role');

        $menu = new Menu();
        $level1 = $menu
            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
            // ->where('menu.compId','=',$compId)
            ->where('menu.menuParent', '=', null)
            ->where('role_menu.rmRoleId', '=', $role)
            ->orderby('menu.menuOrder', 'asc')
            ->get();
        $result = array();
        $index = 0;
        foreach ($level1 as $key => $val) {
            $res1 = array(
                'menuNama' => $val->menuNama,
                'menuRoute' => $val->menuRoute,
                'menuIcon' => $val->menuIcon,
                'menuLevel' => 1,
                // 'menuActive' => $val->menuActive,
                'menuChild' => '',
            );
            $result[] = $res1;

            $level2 = $menu
                ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                // ->where('menu.compId','=',$compId)
                ->where('menu.menuParent', '=', $val->menuId)
                ->where('role_menu.rmRoleId', '=', $role)
                ->orderby('menu.menuOrder', 'asc')
                ->get();
            $res2 = array();
            $index2 = 0;
            foreach ($level2 as $key2 => $val2) {
                $res2[] = array(
                    'menuNama' => $val2->menuNama,
                    'menuRoute' => $val2->menuRoute,
                    'menuIcon' => $val2->menuIcon,
                    'menuLevel' => 2,
                    // 'menuActive' => $val->menuActive,
                    'menuChild' => '',
                );
                $level3 = $menu
                    ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                    // ->where('menu.compId','=',$compId)
                    ->where('menu.menuParent', '=', $val2->menuId)
                    ->where('role_menu.rmRoleId', '=', $role)
                    ->orderby('menu.menuOrder', 'asc')
                    ->get();
                $res3 = array();
                $index3 = 0;
                foreach ($level3 as $key3 => $val3) {
                    $res3[] = array(
                        'menuNama' => $val3->menuNama,
                        'menuRoute' => $val3->menuRoute,
                        'menuIcon' => $val3->menuIcon,
                        'menuLevel' => 3,
                        // 'menuId' => $val3->menuId,
                        'menuChild' => '',
                    );
                    $level4 = $menu
                        ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                        // ->where('menu.compId','=',$compId)
                        ->where('menu.menuParent', '=', $val3->menuId)
                        ->where('role_menu.rmRoleId', '=', $role)
                        ->orderby('menu.menuOrder', 'asc')
                        ->get();
                    $res4 = array();
                    $index4 = 0;
                    foreach ($level4 as $key4 => $val4) {
                        $res4[] = array(
                            'menuNama' => $val4->menuNama,
                            'menuRoute' => $val4->menuRoute,
                            'menuIcon' => $val4->menuIcon,
                            'menuLevel' => 4,
                            // 'menuActive' => $val->menuActive,
                            'menuChild' => '',
                        );

                        $level5 = $menu
                            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
                            // ->where('menu.compId','=',$compId)
                            ->where('menu.menuParent', '=', $val4->menuId)
                            ->where('role_menu.rmRoleId', '=', $role)
                            ->orderby('menu.menuOrder', 'asc')
                            ->get();

                        $res5 = array();
                        foreach ($level5 as $key5 => $val5) {
                            $res5[] = array(
                                'menuNama' => $val5->menuNama,
                                'menuRoute' => $val5->menuRoute,
                                'menuIcon' => $val5->menuIcon,
                                'menuLevel' => 5,
                                // 'menuActive' => $val->menuActive,
                                'menuChild' => '',
                            );
                        }

                        $res4[$index4]['menuChild'] = $res5;
                        $index4++;
                    }
                    $res3[$index3]['menuChild'] = $res4;
                    $index3++;
                }
                $res2[$index2]['menuChild'] = $res3;
                $index2++;
            }
            $result[$index]['menuChild'] = $res2;
            $index++;
        }
        return $result;
    }

    public function checkRouteAuth()
    {

        $routename = Route::currentRouteName();
        $routename = str_replace(".index", "", $routename);

        $role = Session::get('role');
        $menu = new Menu();
        $result = $menu
            ->leftjoin('role_menu', 'role_menu.rmMenuId', '=', 'menu.menuId')
            ->where('menu.menuRoute', '=', $routename)
            ->where('role_menu.rmRoleId', '=', $role)
            ->get();

        //   return count($result);
        if (count($result) > 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function addSysLog($table, $query, $detail)
    {
        $compId = Session::get('compId');
        $nama = Session::get('name');
        $data = array(
            'compId' => $compId,
            'user' => $nama,
            'tabel' => $table,
            'query' => $query,
            'detail' => $detail
        );
        $syslog = new Syslog;
        $syslog->create($data);
    }
}
