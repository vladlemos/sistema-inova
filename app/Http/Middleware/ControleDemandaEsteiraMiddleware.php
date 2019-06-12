<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Classes\Comex\ControleDemandasEsteira;

class ControleDemandaEsteiraMiddleware
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
        dd('parou');
        $controleDemandasEsteira = new ControleDemandasEsteira($request);
        dd($controleDemandasEsteira);
        return $next($request);
    }
}
