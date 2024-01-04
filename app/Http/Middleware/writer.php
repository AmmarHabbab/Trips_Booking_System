<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;
class writer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id',Auth::id())->first();
       // dd($user);
        if ($user->role != 'writer' && $user->role != 'admin') 
        {
            return response()->json(['message','access denied']);
        }

        return $next($request);
    }
}
