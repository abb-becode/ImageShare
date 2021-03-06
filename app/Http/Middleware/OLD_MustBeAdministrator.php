<?php

  namespace App\Http\Middleware;

  use Closure;
  use Illuminate\Http\Request;
  use Symfony\Component\HttpFoundation\Response;

  class MustBeAdministrator
  {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      // auth()->user()? <=> it's optional
      //if (auth()->user()?->username !== 'abb') { // because is duplicated
      if (auth()->user()?->cannot('admin')) {
        abort(Response::HTTP_FORBIDDEN);
      }

      return $next($request);
    }
  }
