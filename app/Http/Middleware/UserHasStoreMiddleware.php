<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
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
                //Verifica se o usuário ja possui uma loja cadastrada
                if(auth()->user()->store->count()){
                    flash('Voce já possui uma loja')->warning();
                    return redirect()->route('admin.stores.index');
                }
                
        return $next($request);
    }
}
