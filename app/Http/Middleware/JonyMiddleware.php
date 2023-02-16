<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\UserController;

use Closure;

class JonyMiddleware {
    public function handle($request, Closure $next) {
        $user = new UserController();
        
        if( $user->isValid() == true ) {
            return $next($request);
        }

        return redirect('/login');
    }
}