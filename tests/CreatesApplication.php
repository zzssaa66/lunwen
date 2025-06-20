<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * This method is called by the base TestCase to bootstrap the Laravel application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        // 根据 Laravel 默认结构，引导 bootstrap 文件
        $app = require __DIR__ . '/../bootstrap/app.php';

        // Bootstrap the application
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}