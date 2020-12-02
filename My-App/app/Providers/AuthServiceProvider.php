<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('AutorizaDDSCH', function ($user){

            if($user->id_rol==0){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('CapDDSCH', function ($user){

            if($user->id_rol==1){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('AutorizaDSPO', function ($user){

            if($user->id_rol==2){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('CapDSPO', function ($user){

            if($user->id_rol==3){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('AutorizaDIPSP', function ($user){

            if($user->id_rol==4){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('ConsultaDGHO', function ($user){

            if($user->id_rol==5){
                return true;
            }else{
                return false;
            }
    

        });

        Gate::define('Plazas', function ($user){

            if($user->id_rol==6){
                return true;
            }else{
                return false;
            }
    

        });
    
    }
}
