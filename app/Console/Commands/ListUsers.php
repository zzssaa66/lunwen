<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '列出所有用户及其角色';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::with('roles')->get();
        
        if ($users->isEmpty()) {
            $this->info('没有找到任何用户。');
            return 0;
        }
        
        $this->info('系统中的所有用户：');
        $this->line('');
        
        $headers = ['ID', '姓名', '邮箱', '角色', '创建时间'];
        $rows = [];
        
        foreach ($users as $user) {
            $roles = $user->roles->pluck('name')->join(', ') ?: '无角色';
            $rows[] = [
                $user->id,
                $user->name,
                $user->email,
                $roles,
                $user->created_at->format('Y-m-d H:i:s')
            ];
        }
        
        $this->table($headers, $rows);
        
        $this->line('');
        $this->info('提示：使用 "php artisan user:assign-admin {email}" 命令为用户分配管理员角色');
        
        return 0;
    }
}
