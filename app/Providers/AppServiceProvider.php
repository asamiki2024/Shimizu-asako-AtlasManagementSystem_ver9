<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
//追加
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin', function($user){
            return ($user->role == "1" || $user->role == "2" || $user->role == "3");
        });
        //カタカナ入力のバリデーションルールを追加
        // 34行目の中身　ｱ-ｹ→全角カタカナ,　ー　→長音符(カタカナでよく使用するもの), +　→1文字以上, u→UTF‐8フラグの意味(/uフラグは、記号や日本語などそのままだと正しく認識出来ないものを認識出来る様に処理してくれるもの)
        Validator::extend('katakana', function ($attribute, $value, $parameters, $validator)
            { 
                return preg_match('/^[ア-ンー]+$/u', $value);
            },  'カタカナで入力してください。');

    }
}