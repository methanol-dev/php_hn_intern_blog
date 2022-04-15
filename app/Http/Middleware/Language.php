<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class Language
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
        if ($lang = $request->session()->get('lang')) {
            App::setLocale($lang);
        }

        View::share(
            'translation',
            collect(File::allFiles(resource_path('lang/' . App::getLocale())))
                ->flatMap(
                    function ($file) {
                        return [
                            ($translation = $file->getBasename('.php')) => trans($translation),
                        ];
                    }
                )->toJson()
        );
        
        return $next($request);
    }
}
