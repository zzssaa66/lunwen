<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-admin {email : 用户邮箱地址}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定用户分配管理员角色';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        // 查找用户
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("用户 {$email} 不存在！");
            return 1;
        }
        
        // 确保 admin 角色存在
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        
        // 检查用户是否已经是管理员
        if ($user->hasRole('admin')) {
            $this->info("用户 {$email} 已经是管理员了！");
            return 0;
        }
        
        // 分配管理员角色
        $user->assignRole('admin');
        
        $this->info("成功为用户 {$email} 分配管理员角色！");
        return 0;
    }
}
