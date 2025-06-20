<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // 注册广播路由，例如 /broadcasting/auth
        Broadcast::routes();

        // 仅当 routes/channels.php 文件存在时再引入
        $channelsPath = base_path('routes/channels.php');
        if (file_exists($channelsPath)) {
            require $channelsPath;
        }
    }
}