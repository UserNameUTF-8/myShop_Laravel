<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use DB;

class TokenValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = DB::select('SELECT * FROM users WHERE token = ?' ,[$request->query('token')]);
       
        if (!$user) {
            return response()->json(['message' => 'token not valid'], 401);
        }
       
        $request->request->add(['user_id' => $user[0]->id]);
        
        return $next($request);
    }
}
