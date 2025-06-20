@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        待评审论文
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
      @endif
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">论文ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">标题</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">作者</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">分配时间</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
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
              {{ $p->pivot->assigned_at? $p->pivot->assigned_at->format('Y-m-d H:i') : '-' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($p->pivot->status==='pending') 待评审 @else 已提交 @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <a href="{{ route('reviewer.papers.show',$p) }}" class="text-gray-600 hover:text-gray-800 text-sm">查看</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('reviewer.papers.review',$p) }}" class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                  <i class="fas fa-clipboard-check mr-1"></i>开始评审
                </a>
              </div>
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