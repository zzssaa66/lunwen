<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🏠 {{ __("控制面板") }}
        </h2>
    </x-slot>

    <div class="py-12 relative">
        <!-- 背景装饰元素 -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-r from-blue-200 to-purple-200 dark:from-blue-800 dark:to-purple-800 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-gradient-to-r from-pink-200 to-red-200 dark:from-pink-800 dark:to-red-800 rounded-full opacity-25 animate-bounce" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 left-1/4 w-24 h-24 bg-gradient-to-r from-green-200 to-teal-200 dark:from-green-800 dark:to-teal-800 rounded-full opacity-15 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- 欢迎卡片 -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 text-white relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative">
                        <h3 class="text-2xl font-bold mb-2">✨ 欢迎回来！</h3>
                        <p class="text-blue-100">{{ __("您已成功登录论文提交系统") }}</p>
                    </div>
                </div>
            </div>
            
            <!-- 功能卡片网格 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 论文提交卡片 -->
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 overflow-hidden shadow-lg rounded-lg border border-white/20 dark:border-gray-700/30 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xl">📝</span>
                            </div>
                            <h4 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">论文提交</h4>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">提交您的学术论文进行评审</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200">
                            立即提交
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- 论文管理卡片 -->
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 overflow-hidden shadow-lg rounded-lg border border-white/20 dark:border-gray-700/30 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xl">📚</span>
                            </div>
                            <h4 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">论文管理</h4>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">查看和管理您的论文状态</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors duration-200">
                            查看论文
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- 评审任务卡片 -->
                <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 overflow-hidden shadow-lg rounded-lg border border-white/20 dark:border-gray-700/30 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xl">🔍</span>
                            </div>
                            <h4 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">评审任务</h4>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">查看待评审的论文</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-200">
                            开始评审
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- 统计信息 -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white/60 backdrop-blur-sm dark:bg-gray-800/60 p-4 rounded-lg border border-white/20 dark:border-gray-700/30">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">已提交论文</div>
                    </div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm dark:bg-gray-800/60 p-4 rounded-lg border border-white/20 dark:border-gray-700/30">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">已通过评审</div>
                    </div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm dark:bg-gray-800/60 p-4 rounded-lg border border-white/20 dark:border-gray-700/30">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">待评审</div>
                    </div>
                </div>
                <div class="bg-white/60 backdrop-blur-sm dark:bg-gray-800/60 p-4 rounded-lg border border-white/20 dark:border-gray-700/30">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">0</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">评审任务</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
