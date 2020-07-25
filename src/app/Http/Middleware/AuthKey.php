<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\Apikeys;

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
      $getKey = Apikeys::where('key', $token)->where('active', 1)->get();

      if($getKey->isEmpty()){
        return response()->json(['message' => 'unauthorized'], 401);
      }
      // if($token != 'jhgfdfghjklkjhgfdsdfghjkx3yPTYKRndAfE9mcCf4aCWy0BfgDZXDD'){
      //   return response()->json(['message' => 'unauthorized'], 401);
      // }
        return $next($request);
    }
}
