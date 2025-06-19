<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndAdminSeeder extends Seeder
{
    public function run()
    {
        // 创建角色
        $roles = ['admin','reviewer','author'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 创建管理员账户（如不存在）
        $adminEmail = 'admin@example.com';
        $admin = User::where('email', $adminEmail)->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make('password'), // 请修改为安全密码
            ]);
            $admin->assignRole('admin');
            echo "Created admin user: {$adminEmail} / password\n";
        }
    }
}