<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PaperController extends Controller
{
    public function __construct()
    {
        // 权限控制已移至路由层，无需在控制器中设置middleware
    }

    // 列出所有论文，供所有认证用户查看
    public function index()
    {
        // 如果用户是作者，显示自己的论文；否则显示所有论文
        if (Auth::user()->role === 'author') {
            $papers = Paper::where('author_id', Auth::id())->orderBy('created_at','desc')->paginate(10);
        } else {
            $papers = Paper::orderBy('created_at','desc')->paginate(10);
        }
        return view('papers.index', compact('papers'));
    }

    // 显示提交论文表单
    public function create()
    {
        return view('papers.create');
    }

    // 处理论文提交
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'abstract'=>'required|string',
            'file'=>'required|file|mimes:pdf|max:20480',
        ]);

        // 上传文件到 storage/app/papers
        $path = $request->file('file')->store('papers');

        Paper::create([
            'title'=>$request->title,
            'abstract'=>$request->abstract,
            'file_path'=>$path,
            'author_id'=>Auth::id(),
            'status'=>'submitted',
            'submitted_at'=>Carbon::now(),
            'current_version'=>1,
        ]);

        return redirect()->route('papers.index')->with('success','论文提交成功，等待管理员分配评审。');
    }

    // 查看论文详情
    public function show(Paper $paper)
    {
        // 移除权限检查，允许所有认证用户查看论文详情
        $reviews = $paper->reviews()->where('version',$paper->current_version)->get();
        return view('papers.show', compact('paper','reviews'));
    }

    // 编辑页面：仅当状态为 revision_requested
    public function edit(Paper $paper)
    {
        abort_unless($paper->author_id===Auth::id() && $paper->status==='revision_requested',403);
        return view('papers.edit', compact('paper'));
    }

    // 更新（修改后重审）
    public function update(Request $request, Paper $paper)
    {
        abort_unless($paper->author_id===Auth::id() && $paper->status==='revision_requested',403);

        $request->validate([
            'title'=>'required|string|max:255',
            'abstract'=>'required|string',
            'file'=>'required|file|mimes:pdf|max:20480',
        ]);

        $path = $request->file('file')->store('papers');
        $paper->update([
            'title'=>$request->title,
            'abstract'=>$request->abstract,
            'file_path'=>$path,
            'status'=>'submitted',
            'submitted_at'=>Carbon::now(),
            'current_version'=>$paper->current_version+1,
            'remarks'=>null,
        ]);

        return redirect()->route('papers.index')->with('success','论文已重新提交，等待管理员再次分配评审。');
    }

    // 文件下载，需鉴权：作者本人、Admin 或被分配的 Reviewer
    public function download(Paper $paper)
    {
        $user = Auth::user();
        $allowed = $user->role === 'admin'
            || ($user->role === 'author' && $paper->author_id===$user->id)
            || ($user->role === 'reviewer' && $paper->reviewers()->where('users.id',$user->id)->exists());
        abort_unless($allowed,403);

        if (!Storage::exists($paper->file_path)) {
            abort(404, '文件未找到');
        }
        $filename = $paper->title . '_v' . $paper->current_version . '.pdf';
        return Storage::download($paper->file_path, $filename);
    }
}