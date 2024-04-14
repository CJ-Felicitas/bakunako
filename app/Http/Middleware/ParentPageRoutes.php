<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Enums\UserTypeEnum;
use Session;

class ParentPageRoutes
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
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect('/');
        }
        if (!$user && (($user->user_type_id == UserTypeEnum::ADMINISTRATOR) || ($user->user_type_id == UserTypeEnum::HEALTHCARE_PROVIDER))) {
            Session::flush();
            return redirect('/login');
        }
        return $next($request);
    }
}
