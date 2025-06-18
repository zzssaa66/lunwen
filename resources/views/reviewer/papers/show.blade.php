@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        评审论文详情
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <h3 class="text-lg font-bold mb-2">{{ $paper->title }} (v{{ $paper->current_version }})</h3>
      <p class="mb-2"><strong>作者：</strong>{{ $paper->author->name }}</p>
      <p class="mb-2"><strong>摘要：</strong>{{ $paper->abstract }}</p>
      <a href="{{ route('papers.download',$paper) }}" class="inline-block mb-4 text-blue-600">下载 PDF</a>

      @if(isset($reviewsOfThisVersion) && $reviewsOfThisVersion)
        <div class="border p-3 rounded mb-3">
          <p><strong>您已提交的评审：</strong></p>
          <p><strong>推荐：</strong>
            @switch($reviewsOfThisVersion->recommendation)
              @case('accept') 接受 @break
              @case('minor_revision') 小修改 @break
              @case('major_revision') 大修改 @break
              @case('reject') 拒绝 @break
            @endswitch
          </p>
          <p class="mt-2 whitespace-pre-line"><strong>意见：</strong><br>{{ $reviewsOfThisVersion->comments }}</p>
        </div>
      @else
        <!-- 评审表单 -->
        <form method="POST" action="{{ route('reviewer.papers.review.submit', $paper) }}">
          @csrf
          <div class="mb-4">
            <label for="recommendation" class="block text-sm font-medium text-gray-700">推荐结果</label>
            <select name="recommendation" id="recommendation" class="mt-1 block w-full border-gray-300 rounded">
              <option value="accept">接受</option>
              <option value="minor_revision">小修改</option>
              <option value="major_revision">大修改</option>
              <option value="reject">拒绝</option>
            </select>
            @error('recommendation')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="comments" class="block text-sm font-medium text-gray-700">评审意见</label>
            <textarea name="comments" id="comments" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded">{{ old('comments') }}</textarea>
            @error('comments')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">提交评审</button>
        </form>
      @endif

    </div>
  </div>
</div>
@endsection