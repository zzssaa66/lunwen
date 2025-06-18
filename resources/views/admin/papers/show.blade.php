@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        论文详情 - ID {{ $paper->id }}
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <h3 class="text-lg font-bold mb-2">{{ $paper->title }} (v{{ $paper->current_version }})</h3>
      <p class="mb-2"><strong>作者：</strong>{{ $paper->author->name }} ({{ $paper->author->email }})</p>
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

      <!-- 当前分配的评审者 -->
      <div class="mb-6">
        <h4 class="font-semibold">当前分配评审者</h4>
        @if($paper->reviewers->count())
          <ul class="list-disc list-inside">
            @foreach($paper->reviewers as $rev)
              <li>
                {{ $rev->name }}
                @php
                  $pivot = $rev->pivot;
                @endphp
                - 分配时间: {{ $pivot->assigned_at? $pivot->assigned_at->format('Y-m-d H:i') : '-' }}
                - 状态: 
                @if($pivot->status==='pending') 待评审 
                @else 已提交 ({{ $pivot->review_submitted_at? $pivot->review_submitted_at->format('Y-m-d H:i') : '-' }}) 
                @endif
              </li>
            @endforeach
          </ul>
        @else
          <p>尚未分配评审者。</p>
        @endif
      </div>

      <!-- 分配评审表单 -->
      <div class="mb-6 border-t pt-4">
        <h4 class="font-semibold mb-2">分配评审者</h4>
        <form method="POST" action="{{ route('admin.papers.assign', $paper) }}">
          @csrf
          <div class="mb-2">
            <label for="reviewers" class="block text-sm font-medium text-gray-700">选择评审者（Ctrl+点击多选）</label>
            <select name="reviewers[]" id="reviewers" multiple class="mt-1 block w-full border-gray-300 rounded">
              @foreach($reviewers as $revOption)
                <option value="{{ $revOption->id }}"
                  @if($paper->reviewers->pluck('id')->contains($revOption->id)) selected @endif>
                  {{ $revOption->name }} ({{ $revOption->email }})
                </option>
              @endforeach
            </select>
            @error('reviewers')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">分配评审者</button>
        </form>
      </div>

      <!-- 显示已有评审意见 -->
      @if($paper->reviews->count())
        <div class="mb-6 border-t pt-4">
          <h4 class="font-semibold mb-2">已有评审意见（当前版本）</h4>
          @foreach($paper->reviews as $r)
            <div class="border p-3 rounded mb-3">
              <p><strong>评审者：</strong>{{ $r->reviewer->name }}</p>
              <p><strong>推荐：</strong>
                @switch($r->recommendation)
                  @case('accept') 接受 @break
                  @case('minor_revision') 小修改 @break
                  @case('major_revision') 大修改 @break
                  @case('reject') 拒绝 @break
                @endswitch
              </p>
              <p class="mt-2 whitespace-pre-line"><strong>意见：</strong><br>{{ $r->comments }}</p>
            </div>
          @endforeach
        </div>
      @endif

      <!-- 决策表单 -->
      <div class="border-t pt-4">
        <h4 class="font-semibold mb-2">管理员决策</h4>
        <form method="POST" action="{{ route('admin.papers.decision', $paper) }}">
          @csrf
          <div class="mb-4">
            <label for="decision" class="block text-sm font-medium text-gray-700">决策</label>
            <select name="decision" id="decision" class="mt-1 block w-full border-gray-300 rounded">
              <option value="accepted" {{ $paper->status==='accepted'?'selected':'' }}>接受</option>
              <option value="revision_requested" {{ $paper->status==='revision_requested'?'selected':'' }}>需要修改</option>
              <option value="rejected" {{ $paper->status==='rejected'?'selected':'' }}>拒绝</option>
            </select>
            @error('decision')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="remarks" class="block text-sm font-medium text-gray-700">备注（可选）</label>
            <textarea name="remarks" id="remarks" rows="3"
                      class="mt-1 block w-full border-gray-300 rounded">{{ old('remarks', $paper->remarks) }}</textarea>
            @error('remarks')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded">保存决策</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection