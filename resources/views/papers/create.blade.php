@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        提交论文
    </h2>
@endsection

@section('content')
<div class="py-8">
  <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
    <!-- 页面头部 -->
    <div class="mb-8">
      <div class="flex items-center">
        <a href="{{ route('papers.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </a>
        <div>
          <h1 class="text-2xl font-bold text-gray-900">提交论文</h1>
          <p class="mt-1 text-sm text-gray-600">请填写论文信息并上传PDF文件</p>
        </div>
      </div>
    </div>

    <!-- 表单卡片 -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">论文信息</h3>
      </div>
      
      <form method="POST" action="{{ route('papers.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        
        <!-- 标题 -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 mb-2">论文标题 <span class="text-red-500">*</span></label>
          <input type="text" name="title" id="title" value="{{ old('title') }}"
                 class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                 placeholder="请输入论文标题">
          @error('title')
            <div class="mt-2 flex items-center text-sm text-red-600">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- 摘要 -->
        <div>
          <label for="abstract" class="block text-sm font-medium text-gray-700 mb-2">论文摘要 <span class="text-red-500">*</span></label>
          <textarea name="abstract" id="abstract" rows="6"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                    placeholder="请输入论文摘要，简要描述研究内容、方法和结论">{{ old('abstract') }}</textarea>
          @error('abstract')
            <div class="mt-2 flex items-center text-sm text-red-600">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- 文件上传 -->
        <div>
          <label for="file" class="block text-sm font-medium text-gray-700 mb-2">论文文件 <span class="text-red-500">*</span></label>
          <div id="file-upload-area" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition duration-150 ease-in-out cursor-pointer">
            <div class="space-y-1 text-center">
              <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div id="upload-text" class="flex text-sm text-gray-600">
                <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                  <span>点击选择文件</span>
                  <input id="file" name="file" type="file" accept="application/pdf" class="sr-only">
                </label>
                <p class="pl-1">或拖拽文件到此处</p>
              </div>
              <p id="upload-hint" class="text-xs text-gray-500">仅支持 PDF 格式，最大 20MB</p>
            </div>
          </div>
          
          <!-- 文件预览区域 -->
          <div id="file-preview" class="mt-3 hidden">
            <div class="flex items-center p-3 bg-blue-50 border border-blue-200 rounded-lg">
              <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
              </svg>
              <div class="flex-1">
                <p id="file-name" class="text-sm font-medium text-blue-900"></p>
                <p id="file-size" class="text-xs text-blue-600"></p>
              </div>
              <button type="button" id="remove-file" class="ml-3 text-blue-400 hover:text-blue-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
              </button>
            </div>
          </div>
          
          @error('file')
            <div class="mt-2 flex items-center text-sm text-red-600">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
              </svg>
              {{ $message }}
            </div>
          @enderror
        </div>

        <!-- 提交按钮 -->
        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
          <a href="{{ route('papers.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
            取消
          </a>
          <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            提交论文
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('file');
    const fileUploadArea = document.getElementById('file-upload-area');
    const filePreview = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');
    const removeFileBtn = document.getElementById('remove-file');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadText = document.getElementById('upload-text');
    const uploadHint = document.getElementById('upload-hint');

    // 点击上传区域触发文件选择
    fileUploadArea.addEventListener('click', function(e) {
        if (e.target !== fileInput) {
            fileInput.click();
        }
    });

    // 文件选择处理
    fileInput.addEventListener('change', function(e) {
        handleFileSelect(e.target.files[0]);
    });

    // 拖拽功能
    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileUploadArea.classList.add('border-blue-400', 'bg-blue-50');
    });

    fileUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('border-blue-400', 'bg-blue-50');
    });

    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelect(files[0]);
        }
    });

    // 移除文件
    removeFileBtn.addEventListener('click', function() {
        fileInput.value = '';
        filePreview.classList.add('hidden');
        fileUploadArea.classList.remove('hidden');
    });

    // 处理文件选择
    function handleFileSelect(file) {
        if (!file) return;

        // 验证文件类型
        if (file.type !== 'application/pdf') {
            alert('请选择PDF格式的文件');
            fileInput.value = '';
            return;
        }

        // 验证文件大小 (20MB = 20 * 1024 * 1024 bytes)
        const maxSize = 20 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('文件大小不能超过20MB');
            fileInput.value = '';
            return;
        }

        // 显示文件信息
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        
        // 隐藏上传区域，显示预览
        fileUploadArea.classList.add('hidden');
        filePreview.classList.remove('hidden');
    }

    // 格式化文件大小
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
@endsection