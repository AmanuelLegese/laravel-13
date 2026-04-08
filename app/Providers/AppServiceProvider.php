<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // call rate limit configuration
        $this->confugureRateLimiter();

        // call scrumble configuration
        $this->ConfigureScrumble();

        // grant super admin all permission and role
        $this->grantSuperAdmin();
    }

    /**
     * configure rate limiter
     */

    private function confugureRateLimiter()
    {
        /**
         * for all api's
         */
        RateLimiter::for('api', function (Request $request) {
            return RateLimiter::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        /**
         * for auth's
         */
        RateLimiter::for('auth', function (Request $request) {
            return RateLimiter::perMinute(5)->by($request->ip());
        });

        /**
         * file uploads
         */
        RateLimiter::for('uploads', function (Request $request) {
            return $request->user()
                ? Limit::perMinute(100)->by($request->user()->id)
                : Limit::perMinute(10)->by($request->ip());
        });
    }

    /**
     * configure scramble
     */

    private function ConfigureScrumble()
    {
        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });
    }

    /**
     * handle permission for super admin
     */
    private function grantSuperAdmin()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
