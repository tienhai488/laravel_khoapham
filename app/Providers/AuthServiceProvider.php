<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($doctor, string $token) {
            return route('doctor.reset-password',['token'=>$token]).'?email='.$doctor->email;
        });

        // // cach 1
        // Gate::define('post.edit', function (User $user,Post $post) {
        //     return $user->id == $post->user_id;
        // });

        // cach 2
        Gate::define('post.edit', [PostPolicy::class,'edit']);
    }
}