<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('jwt_token');

        
        try {
            $secretKey = (string)getenv("JWTENCODE");

            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

            $email = $decoded->email;

            $id = $decoded->id;

            $query = 'SELECT u.email, u.name FROM tableusers u WHERE u.email = :email';

            $result = DB::select($query, ['email' => $email]);

            $rowCount = count($result);

            if ($rowCount <= 0) {
                throw new \Exception('User not found');
            }

            $request->attributes->add([
                'email' => $email,
                'id' => $id,
                'name' => $result[0]->name,
            ]);

            return $next($request);
        } catch (\Throwable $th) {
            return redirect(route('auth.login'))->withErrors(['Error_Login' => 'UNAUTHORIZED USER']);
        }
    }
}
