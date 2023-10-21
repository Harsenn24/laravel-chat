<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \Firebase\JWT\JWT;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    public function logout(Request $request)
    {

        $idUser = $request->attributes->get('id');

        Log::alert($idUser);

        DB::table('tableusers')->where('id',  $idUser)->update(['online'=> 0]);

        $request->session()->forget('jwt_token');

        return redirect(route('auth.login'));
    }
    public function loginForm()
    {
        return view('auths.login');
    }

    public function login(Request $request)
    {
        $data_input = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $data_input['email'];

        $query = 'SELECT u.email, u.password, u.id FROM tableusers u WHERE u.email = :email';

        $result = DB::select($query, ['email' => $email]);

        if (count($result) <= 0) {
            return back()->withInput()->withErrors(['Error_Login' => 'username or password is incorrect!']);
        }

        $hashpassword = $result[0]->password;

        $verifypass = password_verify($data_input['password'], $hashpassword);

        if (!$verifypass) {
            return back()->withInput()->withErrors(['Error_Login' => 'username or password is incorrect!']);
        }

        Log::alert($result[0]->id);

        DB::table('tableusers')->where('id', $result[0]->id)->update(['online'=> 1]);

        $secretKey = (string)getenv("JWTENCODE");

        $payload = array(
            "id" => $result[0]->id,
            "email" => $result[0]->email,
        );

        $token = JWT::encode($payload, $secretKey, 'HS256');

        $request->session()->put('jwt_token', $token);

        return redirect(route('content.showUser'))->with('token_access', $token);
    }
    public function registerForm()
    {

        return view('auths.register');
    }

    public function register(Request $request)
    {
        $data_input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $data_input['email'];

        $query = 'SELECT u.email FROM tableusers u WHERE u.email = :email';

        $result = DB::select($query, ['email' => $email]);

        $rowCount = count($result);

        if ($rowCount > 0) {
            return back()->withInput()->withErrors(['email' => 'Email already exists.']);
        }

        $hashedPassword = password_hash($data_input['password'], PASSWORD_DEFAULT);

        $userAttributes = [
            'name' => $data_input['name'],
            'email' => $data_input['email'],
            'password' => $hashedPassword,
        ];

        User::create($userAttributes);

        return redirect(route('auth.login'))->with('success', 'create user success!');
    }
}
