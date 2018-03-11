<?php
/**
 * Created by PhpStorm.
 * User: mkytka
 * Date: 4.2.2018
 * Time: 18:27
 */

namespace App\Http\Middleware;
use Closure;

class CheckApiVersion
{
    public function handle($request, Closure $next)
    {
        return redirect('/api/v1/people/version');


        //return $next($request);
    }
}