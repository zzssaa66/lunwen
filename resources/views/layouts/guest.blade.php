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
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo 和标题 -->
            <div class="mb-8">
                <a href="/" class="block">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-600 rounded-lg shadow-sm">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                        </svg>
                    </div>
                </a>
                <h1 class="text-center mt-4 text-2xl font-bold text-gray-900">
                    论文管理系统
                </h1>
                <p class="text-center text-sm text-gray-600 mt-1">
                    学术研究管理平台
                </p>
            </div>

            <!-- 表单卡片 -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-sm border border-gray-200 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
            
            <!-- 底部信息 -->
            <div class="mt-6 text-center text-xs text-gray-500">
                <p>© 2024 论文管理系统</p>
            </div>
        </div>
    </body>
</html>
