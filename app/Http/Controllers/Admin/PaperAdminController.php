<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class PaperAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    // 列出所有论文，可通过 ?status=xxx 筛选
    public function index(Request $request)
    {
        $query = Paper::with('author');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $papers = $query->orderBy('submitted_at','desc')->paginate(15);
        return view('admin.papers.index', compact('papers'));
    }

    // 详情页：查看论文信息、当前分配情况、已有评审意见
    public function show(Paper $paper)
    {
        $paper->load([
            'author',
            'reviewers',
            'reviews' => function($q) use ($paper) {
                $q->where('version', $paper->current_version);
            }
        ]);
        $reviewers = User::role('reviewer')->get();
        return view('admin.papers.show', compact('paper','reviewers'));
    }

    // 分配评审者：前端表单提交 reviewers 数组
    public function assignReviewers(Request $request, Paper $paper)
    {
        $request->validate([
            'reviewers' => 'required|array|min:1',
            'reviewers.*' => 'exists:users,id',
        ]);

        // 先清除旧分配
        $paper->reviewers()->detach();
        $now = Carbon::now();
        foreach ($request->reviewers as $rid) {
            $paper->reviewers()->attach($rid, [
                'assigned_at' => $now,
                'status' => 'pending',
            ]);
        }
        $paper->update(['status'=>'under_review']);

        // 发送通知给评审者（需先创建 Notification 类）
        $reviewers = User::whereIn('id',$request->reviewers)->get();
        // Notification::send($reviewers, new \App\Notifications\PaperAssignedNotification($paper));

        return redirect()->route('admin.papers.show', $paper)->with('success','已分配评审者，状态更新为“审核中”。');
    }

    // 做决策：提交 decision 字段 accepted/rejected/revision_requested，以及 remarks
    public function makeDecision(Request $request, Paper $paper)
    {
        $request->validate([
            'decision'=>'required|in:accepted,rejected,revision_requested',
            'remarks'=>'nullable|string',
        ]);
        $paper->update([
            'status'=>$request->decision,
            'remarks'=>$request->remarks,
            'decision_at'=>Carbon::now(),
        ]);
        // 通知作者
        // Notification::send($paper->author, new \App\Notifications\PaperDecisionNotification($paper));
        return redirect()->route('admin.papers.show', $paper)->with('success','决策已保存并通知作者（如已启用通知）。');
    }
}