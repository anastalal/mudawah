<?php

namespace App\Providers;
use Laravel\Passport\Passport;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Passport\Token;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // if (! $this->app->routesAreCached()) {
        //     Passport::routes();
        // }
       // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        // Passport::loadKeysFrom(__DIR__.'/secrets/oauth');
        //Passport::hashClientSecrets();

        //Passport::useTokenModel(Token::class);
        Passport::tokensExpireIn(now()->addDays(15));
    Passport::refreshTokensExpireIn(now()->addDays(30));
    Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
