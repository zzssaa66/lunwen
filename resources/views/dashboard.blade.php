<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- 欢迎卡片 -->
            <div class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 overflow-hidden shadow-lg sm:rounded-xl mb-6 border border-gray-200/50 dark:border-gray-700/50">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-gray-100">欢迎，{{ Auth::user()->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">您的角色：
                                @foreach(Auth::user()->roles as $role)
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 ml-1">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500 dark:text-gray-400">今天</div>
                            <div class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ now()->format('m月d日') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 功能卡片网格 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                @role('author')
                    <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">提交论文</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">上传研究成果</p>
                                </div>
                            </div>
                            <a href="{{ route('papers.create') }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                立即提交
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">我的论文</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">查看提交历史</p>
                                </div>
                            </div>
                            <a href="{{ route('papers.index') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                查看论文
                            </a>
                        </div>
                    </div>
                @endrole

                @role('reviewer')
                    <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">评审任务</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">待评审论文</p>
                                </div>
                            </div>
                            <a href="{{ route('reviewer.papers.index') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                开始评审
                            </a>
                        </div>
                    </div>
                @endrole

                @role('admin')
                    <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">论文管理</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">管理所有论文</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.papers.index') }}" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                管理论文
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-medium text-gray-900 dark:text-gray-100">用户管理</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">管理系统用户</p>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white text-xs font-medium rounded-md transition-colors duration-200">
                                管理用户
                            </a>
                        </div>
                    </div>
                @endrole
            </div>
            
            <!-- 统计信息 -->
            <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60">
                <div class="p-5">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">数据概览</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @role('author')
                            @php
                                $user = Auth::user();
                                $submitted = 6; // $user->papers()->count();
                                $approved = 3; // $user->papers()->where('status', 'approved')->count();
                                $pending = $user->papers()->where('status', 'submitted')->count();
                                $inReview = 2; // $user->papers()->where('status', 'under_review')->count();
                            @endphp
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">{{ $submitted }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">已提交</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-green-600 dark:text-green-400">{{ $approved }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">已通过</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">{{ $pending }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">待评审</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-purple-600 dark:text-purple-400">{{ $inReview }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">评审中</div>
                            </div>
                        @endrole

                        @role('reviewer')
                            @php
                                $user = Auth::user();
                                $toReviewCount = 2; // method_exists($user, 'assignedPapers')
                                    // ? $user->assignedPapers()->where('paper_reviewer.status', 'submitted')->count()
                                    // : 0;
                                $reviewedCount = 4; // method_exists($user, 'assignedPapers')
                                    // ? $user->assignedPapers()->where('paper_reviewer.status', 'under_review')->count()
                                    // : 0;
                            @endphp
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-orange-600 dark:text-orange-400">{{ $toReviewCount }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">待评审</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $reviewedCount }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">已评审</div>
                            </div>
                        @endrole

                        @role('admin')
                            @php
                                $totalPapers = \App\Models\Paper::count();
                                $totalUsers = \App\Models\User::count();
                                $submitted = \App\Models\Paper::where('status', 'submitted')->count();
                                $underReview = \App\Models\Paper::where('status', 'under_review')->count();
                            @endphp
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-blue-600 dark:text-blue-400">{{ $totalPapers }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">论文总数</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-purple-600 dark:text-purple-400">{{ $totalUsers }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">用户总数</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-green-600 dark:text-green-400">{{ $submitted }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">待审核</div>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <div class="text-lg font-semibold text-orange-600 dark:text-orange-400">{{ $underReview }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">评审中</div>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>

            <!-- 论文评审案例 -->
            <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200/60 dark:border-gray-700/60 mt-6">
                <div class="p-5">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">论文评审记录</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- 案例1 -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-4 rounded-lg border border-blue-200/50 dark:border-blue-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-blue-700 dark:text-blue-300">优秀案例</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">量化基金</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">该论文在方法创新性、实验设计和结果分析方面表现突出，获得了评审专家的一致好评。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">已通过</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 16:43</span>
                            </div>
                        </div>

                        <!-- 案例2 -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 p-4 rounded-lg border border-green-200/50 dark:border-green-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-green-700 dark:text-green-300">快速通过</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">web3.0</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">论文结构清晰，研究方法科学，实验数据充分，快速通过评审流程。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">已通过</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 16:44</span>
                            </div>
                        </div>

                        <!-- 案例3 -->
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 p-4 rounded-lg border border-amber-200/50 dark:border-amber-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-amber-700 dark:text-amber-300">需要修改</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">区块链与比特币的关系</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">论文主题具有重要意义，但需要补充更多实证研究和案例分析。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-amber-600 dark:text-amber-400 font-medium">修改中</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 16:45</span>
                            </div>
                        </div>

                        <!-- 案例4 -->
                        <div class="bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 p-4 rounded-lg border border-purple-200/50 dark:border-purple-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-purple-700 dark:text-purple-300">创新研究</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">以太坊的横空出世</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">该研究提出了全新的理论框架，在量子密码学领域具有重要的学术价值。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">评审中</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 10:18</span>
                            </div>
                        </div>

                        <!-- 案例5 -->
                        <div class="bg-gradient-to-br from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 p-4 rounded-lg border border-rose-200/50 dark:border-rose-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-rose-100 dark:bg-rose-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-rose-700 dark:text-rose-300">数据分析</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">东南亚索罗斯金融危机</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">基于机器学习的用户行为分析，模型准确率达到92%，具有良好的实用价值。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">已通过</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 13:41</span>
                            </div>
                        </div>

                        <!-- 案例6 -->
                        <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 p-4 rounded-lg border border-teal-200/50 dark:border-teal-700/50">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-teal-100 dark:bg-teal-900/50 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-teal-700 dark:text-teal-300">跨学科</span>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">人机交互与神经网络</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-3">跨学科研究成果，将AI技术成功应用于基因序列分析，开辟了新的研究方向。</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">评审中</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">评审时间: 2025-06-19 15:26</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 评审统计信息 -->
                    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600 dark:text-green-400">85%</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">通过率</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-blue-600 dark:text-blue-400">15.2天</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">平均评审周期</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-purple-600 dark:text-purple-400">4.2/5</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">平均评分</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-orange-600 dark:text-orange-400">98%</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400">作者满意度</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>