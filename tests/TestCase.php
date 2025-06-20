<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * 在每个测试前运行，自动迁移并 seed 角色等。
     */
    protected function setUp(): void
    {
        parent::setUp();

        // 如果需要给测试用例预先填充角色、管理员等数据，请确保对应 Seeder 已存在
        // 例：Database\Seeders\RolesAndAdminSeeder 中创建了 'author','reviewer','admin' 等角色
        $this->artisan('db:seed', ['--class' => \Database\Seeders\RolesAndAdminSeeder::class]);
    }
    
}