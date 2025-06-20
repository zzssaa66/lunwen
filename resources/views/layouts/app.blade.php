<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - 论文提交系统</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased relative">
    <!-- 全局背景装饰 -->
    <div class="fixed inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-blue-900 dark:to-purple-900 pointer-events-none">
        <!-- 浮动装饰元素 -->
        <div class="absolute top-20 left-20 w-32 h-32 bg-gradient-to-r from-pink-200/30 to-purple-200/30 dark:from-pink-800/20 dark:to-purple-800/20 rounded-full animate-pulse"></div>
        <div class="absolute top-1/3 right-10 w-24 h-24 bg-gradient-to-r from-blue-200/40 to-cyan-200/40 dark:from-blue-800/20 dark:to-cyan-800/20 rounded-full animate-bounce" style="animation-delay: 2s; animation-duration: 3s;"></div>
        <div class="absolute bottom-1/4 left-10 w-28 h-28 bg-gradient-to-r from-green-200/25 to-teal-200/25 dark:from-green-800/15 dark:to-teal-800/15 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 right-1/4 w-20 h-20 bg-gradient-to-r from-yellow-200/35 to-orange-200/35 dark:from-yellow-800/20 dark:to-orange-800/20 rounded-full animate-bounce" style="animation-delay: 0.5s; animation-duration: 4s;"></div>
    </div>
    
    <div class="min-h-screen relative z-10">
        @include('layouts.navigation') <!-- Breeze 默认导航 -->
        
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white/80 backdrop-blur-sm dark:bg-gray-800/80 shadow border-b border-white/20 dark:border-gray-700/30">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="relative">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
