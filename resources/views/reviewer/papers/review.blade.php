<x-app-layout>
@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        论文评审 - {{ $paper->title }}
    </h2>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- 论文信息卡片 -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $paper->title }}</h1>
                        <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                            <span><i class="fas fa-user mr-1"></i>作者：{{ $paper->author->name }}</span>
                            <span><i class="fas fa-calendar mr-1"></i>提交时间：{{ $paper->created_at->format('Y-m-d H:i') }}</span>
                            <span><i class="fas fa-tag mr-1"></i>版本：v{{ $paper->current_version }}</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('papers.download', $paper) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i>下载PDF
                        </a>
                        <a href="{{ route('reviewer.papers.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>返回列表
                        </a>
                    </div>
                </div>
                
                <!-- 摘要 -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">摘要</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $paper->abstract }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- 评审表单 -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        @if(isset($reviewsOfThisVersion) && $reviewsOfThisVersion)
                            <!-- 已提交的评审 -->
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">评审已提交</h3>
                                        <p class="text-sm text-green-600 dark:text-green-300">您已完成对此论文的评审</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-green-900 dark:text-green-100 mb-1">推荐结果</label>
                                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                            @switch($reviewsOfThisVersion->recommendation)
                                                @case('accept') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 @break
                                                @case('minor_revision') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 @break
                                                @case('major_revision') bg-orange-100 text-orange-800 dark:bg-orange-800 dark:text-orange-100 @break
                                                @case('reject') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 @break
                                            @endswitch">
                                            @switch($reviewsOfThisVersion->recommendation)
                                                @case('accept') <i class="fas fa-check mr-1"></i>接受 @break
                                                @case('minor_revision') <i class="fas fa-edit mr-1"></i>小修改 @break
                                                @case('major_revision') <i class="fas fa-exclamation-triangle mr-1"></i>大修改 @break
                                                @case('reject') <i class="fas fa-times mr-1"></i>拒绝 @break
                                            @endswitch
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-green-900 dark:text-green-100 mb-2">评审意见</label>
                                        <div class="bg-white dark:bg-gray-700 border border-green-200 dark:border-green-600 rounded-lg p-4">
                                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $reviewsOfThisVersion->comments }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="text-sm text-green-600 dark:text-green-400">
                                        <i class="fas fa-clock mr-1"></i>提交时间：{{ $reviewsOfThisVersion->created_at->format('Y-m-d H:i:s') }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- 评审表单 -->
                            <div class="mb-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                                    <i class="fas fa-clipboard-check mr-2 text-blue-600"></i>开始评审
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">请仔细阅读论文内容，并根据学术标准给出客观、公正的评审意见。</p>
                            </div>

                            @if(session('error'))
                                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                        <span class="text-red-700 dark:text-red-300">{{ session('error') }}</span>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('reviewer.papers.review.submit', $paper) }}" class="space-y-6">
                                @csrf
                                
                                <!-- 推荐结果 -->
                                <div>
                                    <label for="recommendation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-star mr-1"></i>推荐结果 <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="relative flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <input type="radio" name="recommendation" value="accept" class="sr-only" {{ old('recommendation') == 'accept' ? 'checked' : '' }}>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-green-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full hidden"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-green-700 dark:text-green-300">接受</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">论文质量优秀，建议接受</div>
                                                </div>
                                            </div>
                                        </label>
                                        
                                        <label class="relative flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <input type="radio" name="recommendation" value="minor_revision" class="sr-only" {{ old('recommendation') == 'minor_revision' ? 'checked' : '' }}>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-yellow-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-yellow-500 rounded-full hidden"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-yellow-700 dark:text-yellow-300">小修改</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">需要轻微修改后接受</div>
                                                </div>
                                            </div>
                                        </label>
                                        
                                        <label class="relative flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <input type="radio" name="recommendation" value="major_revision" class="sr-only" {{ old('recommendation') == 'major_revision' ? 'checked' : '' }}>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-orange-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-orange-500 rounded-full hidden"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-orange-700 dark:text-orange-300">大修改</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">需要重大修改后重审</div>
                                                </div>
                                            </div>
                                        </label>
                                        
                                        <label class="relative flex items-center p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                            <input type="radio" name="recommendation" value="reject" class="sr-only" {{ old('recommendation') == 'reject' ? 'checked' : '' }}>
                                            <div class="flex items-center">
                                                <div class="w-4 h-4 border-2 border-red-500 rounded-full mr-3 flex items-center justify-center">
                                                    <div class="w-2 h-2 bg-red-500 rounded-full hidden"></div>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-medium text-red-700 dark:text-red-300">拒绝</div>
                                                    <div class="text-xs text-gray-500 dark:text-gray-400">论文不符合发表标准</div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @error('recommendation')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <!-- 评审意见 -->
                                <div>
                                    <label for="comments" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-comment-alt mr-1"></i>评审意见 <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <textarea name="comments" id="comments" rows="8" 
                                                  placeholder="请详细说明您的评审意见，包括论文的优点、不足以及改进建议..."
                                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 resize-none">{{ old('comments') }}</textarea>
                                        <div class="absolute bottom-3 right-3 text-xs text-gray-400" id="char-count">0 / 1000</div>
                                    </div>
                                    @error('comments')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                
                                <!-- 提交按钮 -->
                                <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-600">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-info-circle mr-1"></i>提交后将无法修改评审意见
                                    </div>
                                    <button type="submit" 
                                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-paper-plane mr-2"></i>提交评审
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- 侧边栏 -->
            <div class="space-y-6">
                <!-- 评审指南 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>评审指南
                        </h3>
                        <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                <span>仔细阅读论文的研究目标、方法和结论</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                <span>评估研究的创新性和学术价值</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                <span>检查实验设计和数据分析的合理性</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                <span>关注论文的写作质量和逻辑结构</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5"></i>
                                <span>提供建设性的改进建议</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- 评审标准 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            <i class="fas fa-star mr-2 text-blue-500"></i>评审标准
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-green-500 pl-4">
                                <div class="font-medium text-green-700 dark:text-green-300">接受</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">研究质量高，创新性强，可直接发表</div>
                            </div>
                            <div class="border-l-4 border-yellow-500 pl-4">
                                <div class="font-medium text-yellow-700 dark:text-yellow-300">小修改</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">整体质量良好，需要轻微修改</div>
                            </div>
                            <div class="border-l-4 border-orange-500 pl-4">
                                <div class="font-medium text-orange-700 dark:text-orange-300">大修改</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">有潜力但需要重大改进</div>
                            </div>
                            <div class="border-l-4 border-red-500 pl-4">
                                <div class="font-medium text-red-700 dark:text-red-300">拒绝</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">不符合发表标准，建议拒绝</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// 单选按钮交互
document.addEventListener('DOMContentLoaded', function() {
    const radioInputs = document.querySelectorAll('input[name="recommendation"]');
    const radioLabels = document.querySelectorAll('label[for="recommendation"] + div label');
    
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // 重置所有选项
            radioLabels.forEach(label => {
                label.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
                label.classList.add('border-gray-300', 'dark:border-gray-600');
                const dot = label.querySelector('.w-2.h-2');
                if (dot) dot.classList.add('hidden');
            });
            
            // 高亮选中的选项
            const selectedLabel = this.closest('label');
            selectedLabel.classList.remove('border-gray-300', 'dark:border-gray-600');
            selectedLabel.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            const selectedDot = selectedLabel.querySelector('.w-2.h-2');
            if (selectedDot) selectedDot.classList.remove('hidden');
        });
    });
    
    // 字符计数
    const textarea = document.getElementById('comments');
    const charCount = document.getElementById('char-count');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = `${count} / 1000`;
            
            if (count > 1000) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-400');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.add('text-gray-400');
            }
        });
        
        // 初始化计数
        const initialCount = textarea.value.length;
        charCount.textContent = `${initialCount} / 1000`;
    }
});
</script>
@endsection
</x-app-layout>