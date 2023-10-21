<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class authorization
{
    public function handle(Request $request, Closure $next): Response
    {
        $idUser = $request->attributes->get('id');

        $idRoutes = (int)$request->route('id');

        if ($idUser !== $idRoutes) {
            Alert::error('UNAUTHORIZED', 'This account doesnt belong to you');
            return back();
        }

        return $next($request);
    }
}
