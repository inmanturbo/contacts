<?php

namespace Inmanturbo\ContactsManager;

use Closure;
use Illuminate\Http\Request;
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

        Navigation::make()
            ->add('Contacts', route('contacts.v1.index'));

        return $next($request);
    }
}
