<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/11/2
 * Time: 17:15
 */

namespace App\Http\Middleware\admin;

use App\Models\Admin\UserRole;
use Closure;
//use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

use Illuminate\Support\Facades\Auth;

class AuthAuthorization
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        return $next($request);
    }
}