@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        论文管理
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <form method="GET" action="{{ route('admin.papers.index') }}" class="mb-4 flex items-center">
        <label for="status" class="mr-2">状态筛选：</label>
        <select name="status" id="status" class="border-gray-300 rounded">
          <option value="">全部</option>
          <option value="submitted" {{ request('status')=='submitted'?'selected':'' }}>已提交</option>
          <option value="under_review" {{ request('status')=='under_review'?'selected':'' }}>审核中</option>
          <option value="revision_requested" {{ request('status')=='revision_requested'?'selected':'' }}>需修改</option>
          <option value="accepted" {{ request('status')=='accepted'?'selected':'' }}>已接受</option>
          <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>已拒绝</option>
        </select>
        <button type="submit" class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">筛选</button>
      </form>
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
      @endif
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">标题</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">作者</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">提交时间</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($papers as $p)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->author->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              @switch($p->status)
                @case('submitted')<span class="text-gray-600">已提交</span>@break
                @case('under_review')<span class="text-blue-600">审核中</span>@break
                @case('revision_requested')<span class="text-yellow-600">需修改</span>@break
                @case('accepted')<span class="text-green-600">已接受</span>@break
                @case('rejected')<span class="text-red-600">已拒绝</span>@break
              @endswitch
            </td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->submitted_at? $p->submitted_at->format('Y-m-d H:i') : '-' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <a href="{{ route('admin.papers.show',$p) }}" class="text-blue-500">查看</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4">{{ $papers->links() }}</div>
    </div>
  </div>
</div>
@endsection