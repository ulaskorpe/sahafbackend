<?php

namespace App\Http\Middleware;

use App\Http\Services\FrontEndServices;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontEndData
{

    protected $frontEndServices;

    public function __construct(FrontEndServices $frontEndServices){
            $this->frontEndServices = $frontEndServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // return $next($request);

       view()->share('categories', $this->frontEndServices->getCategories());
       return $next($request);
    }
}
