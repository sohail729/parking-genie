<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class CheckIfHost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->status == 0){
                $user = Auth::user();
                Auth::logout();
                $request->session()->flash('alert-danger', $user->email.' is blocked!');        
                return redirect()->back();
            }

        $user = Auth::user();
            if($user->hasRole('host')){
                return $next($request);
            }       
        }       
        
        return redirect()->route('front.home')->with('toastr.error','You are not authorized to access resource! ');;
    }
}
