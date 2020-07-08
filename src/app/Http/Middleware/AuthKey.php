<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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
      $token = $request->header('APP-KEY');
      if($token != 'lPjWNGBIbLRDSji2j9JcL4aGnTV4Cdp2x3yPTYKRndAfE9mcCf4aCWy0BfgDZXDD'){
        return response()->json(['message' => 'unauthorized'], 401);
      }
        return $next($request);
    }
}
