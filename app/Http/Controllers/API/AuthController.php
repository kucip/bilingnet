<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Company;
use Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        Session::put('compId',$user->compId);

        return response()
            ->json(['message' => 'Hi '.$user->name.',companyID='.$user->compId.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function loginweb(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'E-mail & Password Tidak Sesuai',
                    ); 
            return view('login',$data);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        $company = Company::where('compId', $user->compId)->firstOrFail();

        Session::put('compId',$user->compId);
        Session::put('compNama',$company->compNama);
        Session::put('name',$user->name);
        Session::put('email',$user->email);
        Session::put('role',$user->role);

        // $data = array(
        //         'authmenu'=>$this->getusermenu(),
        //         'name' => $user->name,
        //         'namelong' => $user->email,
        //         'company'=>$company->compNama,
        //         'tittle'=>'Dashboad',
        //         'page_tittle'=> 'Biling Management',
        //         'page_active'=>'Dashboad'
        //         );

        return redirect('/');

        // return view('home',$data)->with('data', $data);
    }

    // method for user logout and delete token
    public function logout()
    {
        Session::put('name','');
        Session::put('email','');
        Session::put('compId','');
        Session::put('role','');

        auth()->user()->tokens()->delete();

            $wallidx=rand(1,7);
            $data = array(
                    'wallidx' => $wallidx,
                    'message' => 'Anda telah logout dari system.',
                    ); 
                    
            return view('login',$data);
    }
}