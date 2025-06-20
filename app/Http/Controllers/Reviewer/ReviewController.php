<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:reviewer']);
    }

    // 列出分配给当前评审者的论文
    public function index()
    {
        $papers = Auth::user()->assignedPapers()->orderByPivot('assigned_at','desc')->paginate(10);
        return view('reviewer.papers.index', compact('papers'));
    }

    // 查看论文详情
    public function show(Paper $paper)
    {
        abort_unless($paper->reviewers()->where('users.id',Auth::id())->exists(),403);
        $reviewsOfThisVersion = $paper->reviews()->where('version',$paper->current_version)
            ->where('reviewer_id', Auth::id())
            ->first();
        return view('reviewer.papers.show', compact('paper','reviewsOfThisVersion'));
    }

    // 新的评审页面
    public function review(Paper $paper)
    {
        abort_unless($paper->reviewers()->where('users.id',Auth::id())->exists(),403);
        $reviewsOfThisVersion = $paper->reviews()->where('version',$paper->current_version)
            ->where('reviewer_id', Auth::id())
            ->first();
        return view('reviewer.papers.review', compact('paper','reviewsOfThisVersion'));
    }

    // 提交评审意见
    public function store(Request $request, Paper $paper)
    {
        abort_unless($paper->reviewers()->where('users.id',Auth::id())->exists(),403);

        // 检查是否已对当前版本提交过
        $exists = Review::where('paper_id',$paper->id)
                       ->where('reviewer_id',Auth::id())
                       ->where('version',$paper->current_version)
                       ->exists();
        if ($exists) {
            return redirect()->route('reviewer.papers.show', $paper)->with('error','您已提交过该版本的评审。');
        }

        $request->validate([
            'comments'=>'required|string',
            'recommendation'=>'required|in:accept,minor_revision,major_revision,reject'
        ]);

        Review::create([
            'paper_id'=>$paper->id,
            'reviewer_id'=>Auth::id(),
            'version'=>$paper->current_version,
            'comments'=>$request->comments,
            'recommendation'=>$request->recommendation,
            'submitted_at'=>Carbon::now(),
        ]);

        // 更新 pivot 表状态
        $paper->reviewers()->updateExistingPivot(Auth::id(), [
            'status'=>'completed',
            'review_submitted_at'=>Carbon::now(),
        ]);

        // 可通知 Admin 有新评审提交
        return redirect()->route('reviewer.papers.index')->with('success','评审提交成功');
    }
}