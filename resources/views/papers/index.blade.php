@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        我的论文
    </h2>
@endsection

@section('content')
<div class="py-8">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- 页面头部 -->
    <div class="mb-8">
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">我的论文</h1>
          <p class="mt-1 text-sm text-gray-600">管理和查看您提交的论文</p>
        </div>
        <a href="{{ route('papers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-150 ease-in-out">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          提交新论文
        </a>
      </div>
    </div>

    @if(session('success'))
      <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="flex">
          <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          <p class="ml-3 text-sm text-green-800">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <!-- 论文列表 -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      @if($papers->count() > 0)
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">论文信息</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">提交时间</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($papers as $p)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                  <div class="text-sm font-medium text-gray-900">{{ $p->title }}</div>
                  @if($p->abstract)
                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($p->abstract, 100) }}</div>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @switch($p->status)
                    @case('submitted')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        已提交
                      </span>
                      @break
                    @case('under_review')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        审核中
                      </span>
                      @break
                    @case('revision_requested')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        需修改
                      </span>
                      @break
                    @case('accepted')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        已接受
                      </span>
                      @break
                    @case('rejected')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        已拒绝
                      </span>
                      @break
                  @endswitch
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $p->submitted_at ? $p->submitted_at->format('Y-m-d H:i') : '-' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <a href="{{ route('papers.show',$p) }}" class="text-blue-600 hover:text-blue-900 mr-3">查看详情</a>
                  @if($p->status==='revision_requested')
                    <a href="{{ route('papers.edit',$p) }}" class="text-yellow-600 hover:text-yellow-900">重新提交</a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        @if($papers->hasPages())
          <div class="px-6 py-3 border-t border-gray-200">
            {{ $papers->links() }}
          </div>
        @endif
      @else
        <div class="text-center py-12">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900">暂无论文</h3>
          <p class="mt-1 text-sm text-gray-500">开始提交您的第一篇论文吧</p>
          <div class="mt-6">
            <a href="{{ route('papers.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
              提交论文
            </a>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection