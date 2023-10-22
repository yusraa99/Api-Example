<?php

namespace App\Http\Middleware;

use App\Http\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{

    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    

    public function handle(Request $request, Closure $next)
    {
        $user=null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return $this->returnError('E3001','INVALID_TOKEN')
            }elseif ($e instanceof TokenExpiredException) {
                return $this->returnError('E3001','EXPIRED_TOKEN')
            }else {
                return $this->returnError('E3001','NOTFOUND_TOKEN')
            }      
        }catch (\Throwable $th) {
            if ($th instanceof TokenInvalidException) {
                return $this->returnError('E3001','INVALID_TOKEN')
            }elseif ($th instanceof TokenExpiredException) {
                return $this->returnError('E3001','EXPIRED_TOKEN')
            }else {
                return $this->returnError('E3001','NOTFOUND_TOKEN')
            }      
        }

        if (!$user)
            $this->returnError(trans('Unauthenticated'));
            return $next($request);
    }
}
