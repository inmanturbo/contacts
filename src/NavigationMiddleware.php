<?php

namespace Inmanturbo\ContactsManager;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Navigation\Facades\Navigation;
use Symfony\Component\HttpFoundation\Response;

class NavigationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $contactsVersion = 'v'.ContactsManager::VERSION;
        $contactsRoute = 'contacts.'.$contactsVersion.'.index';

        $route = config('contacts-manager.features.ui.theme') == 'embedded' && Route::has('internal-iframe')
            ? route('internal-iframe', [
                'path' => ltrim(route($contactsRoute, [], false), '/'
            )]) 
            : route($contactsRoute);

        Navigation::make()
            ->add('Contacts', $route);

        return $next($request);
    }
}
