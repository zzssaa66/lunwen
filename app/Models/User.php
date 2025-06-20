<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 关系示例
    public function papers()
    {
        return $this->hasMany(Paper::class, 'author_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function assignedPapers()
    {
        return $this->belongsToMany(Paper::class, 'paper_reviewer', 'reviewer_id', 'paper_id')
                    ->withPivot(['assigned_at','status','review_submitted_at'])
                    ->withTimestamps();
    }
    protected static function booted()
    {
        static::created(function ($user) {
            // 仅当新用户没有任何角色时，分配默认 author
            if (class_exists(\Spatie\Permission\Models\Role::class)) {
                if ($user->roles()->count() === 0) {
                    // 确保 roles 表中有 'author'
                    $user->assignRole('author');
                }
            }
        });
    }
}