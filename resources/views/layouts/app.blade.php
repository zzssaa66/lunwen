<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- 省略 meta、title、CSS 引入 etc. -->
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation') <!-- Breeze 默认导航 -->
        <!-- 这里可以在 navigation 视图中添加角色判断 -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>