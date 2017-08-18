<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Shop;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Total access')) //If user has this //permission
        {
            return $next($request);
        }

        if ($request->is('shops/create'))//If user is creating a post
         {
            if (!Auth::user()->hasPermissionTo('Create Shop'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('shops/*/edit')) //If user is editing a post
        {
            $id = ltrim($request->path(),"shops/");
            $id = chop($id,"/edit");

            $shop = Shop::findOrFail($id);

            if (Auth::user()->hasPermissionTo('Edit Shop') && Auth::user()->id == $shop->user->id  ) {
                return $next($request);
            } else {
                abort('401');
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a post
        {
            $id = ltrim($request->path(),"shops/");
            $shop = Shop::findOrFail($id);
            
            if (!( Auth::user()->hasPermissionTo('Delete Shop') && Auth::user()->id == $shop->user->id )) {
                abort('401');
            } 
            else 
            {
                return $next($request);
            }
        }

        return $next($request);
    }
}