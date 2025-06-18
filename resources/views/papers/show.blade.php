@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        论文详情
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <h3 class="text-lg font-bold mb-2">{{ $paper->title }} (v{{ $paper->current_version }})</h3>
      <p class="mb-2"><strong>状态：</strong>
        @switch($paper->status)
            @case('submitted')<span class="text-gray-600">已提交</span>@break
            @case('under_review')<span class="text-blue-600">审核中</span>@break
            @case('revision_requested')<span class="text-yellow-600">需修改</span>@break
            @case('accepted')<span class="text-green-600">已接受</span>@break
            @case('rejected')<span class="text-red-600">已拒绝</span>@break
        @endswitch
      </p>
      <p class="mb-4"><strong>摘要：</strong>{{ $paper->abstract }}</p>
      <a href="{{ route('papers.download',$paper) }}" class="inline-block mb-4 text-blue-600">下载 PDF</a>

      @if($reviews->count())
        <h4 class="text-md font-semibold mt-6 mb-2">评审意见（当前版本）</h4>
        @foreach($reviews as $r)
          <div class="border p-3 rounded mb-3">
            <p><strong>推荐：</strong>
              @switch($r->recommendation)
                @case('accept') 接受 @break
                @case('minor_revision') 小修改 @break
                @case('major_revision') 大修改 @break
                @case('reject') 拒绝 @break
              @endswitch
            </p>
            <p class="mt-2 whitespace-pre-line">{{ $r->comments }}</p>
          </div>
        @endforeach
      @endif

      @if($paper->status==='revision_requested')
        <div class="mt-4">
          <a href="{{ route('papers.edit',$paper) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">重提交修改稿</a>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection