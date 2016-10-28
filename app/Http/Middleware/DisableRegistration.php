<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\AuthController;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class DisableRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authController = new AuthController();
        //if user is logged in and admin then show the register page
        if(Auth::check()){
            $admin = User::where('email', 'admin@gmail.com')->first();

            if(!($admin)){
                return redirect('/auth/login');
            }
            if($admin){
                return $authController->show();
            }
        }
        else{
            return redirect('/auth/login');
        }

        return $next($request);
    }
}
