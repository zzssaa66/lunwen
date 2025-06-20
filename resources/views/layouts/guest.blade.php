<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased relative overflow-hidden">
        <!-- 背景装饰 -->
        <div class="fixed inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-blue-900 dark:to-purple-900">
            <!-- 浮动装饰元素 -->
            <div class="absolute top-10 left-10 w-40 h-40 bg-gradient-to-r from-pink-200/20 to-purple-200/20 dark:from-pink-800/10 dark:to-purple-800/10 rounded-full animate-pulse"></div>
            <div class="absolute top-1/4 right-20 w-32 h-32 bg-gradient-to-r from-blue-200/30 to-cyan-200/30 dark:from-blue-800/15 dark:to-cyan-800/15 rounded-full animate-bounce" style="animation-delay: 1s; animation-duration: 4s;"></div>
            <div class="absolute bottom-20 left-1/4 w-36 h-36 bg-gradient-to-r from-green-200/15 to-teal-200/15 dark:from-green-800/10 dark:to-teal-800/10 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/3 right-10 w-28 h-28 bg-gradient-to-r from-yellow-200/25 to-orange-200/25 dark:from-yellow-800/15 dark:to-orange-800/15 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
            
            <!-- 学术装饰图标 -->
            <div class="absolute top-1/3 left-1/3 opacity-5 dark:opacity-3">
                <svg class="w-24 h-24 text-indigo-400 animate-spin" style="animation-duration: 30s;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
            </div>
            <div class="absolute bottom-1/4 right-1/3 opacity-5 dark:opacity-3">
                <svg class="w-20 h-20 text-purple-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div class="mb-6">
                <a href="/" class="block">
                    <div class="flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full shadow-lg">
                        <span class="text-white text-2xl font-bold">📚</span>
                    </div>
                </a>
                <h1 class="text-center mt-4 text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    论文提交系统
                </h1>
                <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">
                    学术交流，从这里开始 ✨
                </p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 shadow-xl border border-white/20 dark:border-gray-700/30 overflow-hidden sm:rounded-xl relative">
                <!-- 顶部装饰条 -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400"></div>
                
                {{ $slot }}
            </div>
            
            <!-- 底部装饰文字 -->
            <div class="mt-8 text-center text-xs text-gray-500 dark:text-gray-400">
                <p>🎓 让学术研究更加便捷高效</p>
            </div>
        </div>
    </body>
</html>
