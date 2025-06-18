<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'abstract',
        'file_path',
        'author_id',
        'status',
        'submitted_at',
        'current_version',
        'parent_id',
        'remarks',
    ];

    protected $dates = ['submitted_at','decision_at'];

    // 作者（User）
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // 分配的评审者（User，多对多 pivot: paper_reviewer）
    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'paper_reviewer', 'paper_id', 'reviewer_id')
                    ->withPivot(['assigned_at','status','review_submitted_at'])
                    ->withTimestamps();
    }

    // 关联的评审意见（Review）
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // 版本链：父
    public function parent()
    {
        return $this->belongsTo(Paper::class, 'parent_id');
    }

    // 版本链：子
    public function children()
    {
        return $this->hasMany(Paper::class, 'parent_id');
    }
}