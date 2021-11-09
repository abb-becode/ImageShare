<?php

namespace App\Providers;

use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

      /*app()->bind('foo', function() {
        return 'bar';
      } );*/

      app()->bind(Newsletter::class, function() {  // $this->app->bind <=> app()->bind
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]);

           // Here you can use any service you want instead Mailchimp
           return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Disable all mass assignable restrictions on the models.
         */
        Model::unguard();

        /**
         * Define a named closure
         * This get a logic will be called admin
         * In the closure will verify if the user sent automatically will satisfy the logic below
         */
        Gate::define('admin', function (User $user) {
          return $user->role_id == 1;
        });

        /** Create a Blade Directive called admin that referees to that Gate closure named admin */
        Blade::if('admin', function () {
          // request()->user()? that mean it's optional
          // if not put it optional with ? mark we will send null if nobody logged, and we refresh the page
          // and null don't have a method called can
          return request()->user()?->can('admin');
        });

    }
}
