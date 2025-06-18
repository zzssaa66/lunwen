@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        修改并重提交论文
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      <form method="POST" action="{{ route('papers.update', $paper) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">标题</label>
          <input type="text" name="title" id="title" value="{{ old('title', $paper->title) }}"
                 class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
          @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
          <label for="abstract" class="block text-sm font-medium text-gray-700">摘要</label>
          <textarea name="abstract" id="abstract" rows="4"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('abstract', $paper->abstract) }}</textarea>
          @error('abstract')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
          <label for="file" class="block text-sm font-medium text-gray-700">上传新 PDF 文件</label>
          <input type="file" name="file" id="file" accept="application/pdf" class="mt-1">
          @error('file')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">重提交</button>
      </form>
    </div>
  </div>
</div>
@endsection