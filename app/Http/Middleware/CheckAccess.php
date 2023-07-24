<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user=DB::table('employees')->where('id',Auth::user()->id)->first();
        // $user=User::find(Auth::user()->id);
        if($user->hasPermissionTo($permission)){
            return $next($request);
        }else{
            return redirect('dashboard')->with('error', 'You are not permitted with that!');
        }
    }
    // public function handle(Request $request, Closure $next, $module, $method)
    // {
    //     $access=DB::select("SELECT * FROM `module_access` ma JOIN modules on ma.module_id=modules.id WHERE modules.module='".$module."' AND ma.".$method."=1 AND ma.employee_id=".Auth::user()->id);
    //     if($access){
    //         return $next($request);
    //     }else{
    //         return redirect('dashboard')->with('error', 'You are not permitted with that!');
    //     }
    // }
}
