@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的论文
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">论文列表</h3>
        <a href="{{ route('papers.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">提交新论文</a>
      </div>
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
      @endif
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">标题</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">提交时间</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($papers as $p)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              @switch($p->status)
                @case('submitted')<span class="text-gray-600">已提交</span>@break
                @case('under_review')<span class="text-blue-600">审核中</span>@break
                @case('revision_requested')<span class="text-yellow-600">需修改</span>@break
                @case('accepted')<span class="text-green-600">已接受</span>@break
                @case('rejected')<span class="text-red-600">已拒绝</span>@break
              @endswitch
            </td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $p->submitted_at ? $p->submitted_at->format('Y-m-d H:i') : '-' }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <a href="{{ route('papers.show',$p) }}" class="text-blue-500">查看</a>
              @if($p->status==='revision_requested')
                <a href="{{ route('papers.edit',$p) }}" class="ml-2 text-yellow-500">重提交</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4">
        {{ $papers->links() }}
      </div>
    </div>
  </div>
</div>
@endsection