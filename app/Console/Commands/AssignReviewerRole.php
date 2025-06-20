<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignReviewerRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-reviewer {email : 用户邮箱地址}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为指定用户分配评审者角色';

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
        
        // 确保 reviewer 角色存在
        $reviewerRole = Role::firstOrCreate(['name' => 'reviewer']);
        
        // 检查用户是否已经是评审者
        if ($user->hasRole('reviewer')) {
            $this->info("用户 {$email} 已经是评审者了！");
            return 0;
        }
        
        // 分配评审者角色
        $user->assignRole('reviewer');
        
        $this->info("成功为用户 {$email} 分配评审者角色！");
        return 0;
    }
}
