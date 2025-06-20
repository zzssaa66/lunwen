<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900 text-center">登录账户</h2>
        <p class="mt-1 text-sm text-gray-600 text-center">请输入您的登录信息</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- 邮箱地址 -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">邮箱地址</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                   placeholder="请输入邮箱地址">
            @error('email')
                <div class="mt-2 flex items-center text-sm text-red-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- 密码 -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">密码</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                   placeholder="请输入密码">
            @error('password')
                <div class="mt-2 flex items-center text-sm text-red-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- 记住我和忘记密码 -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-600">记住我</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500">
                    忘记密码？
                </a>
            @endif
        </div>

        <!-- 登录按钮 -->
        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                登录
            </button>
        </div>

        <!-- 注册链接 -->
        <div class="text-center">
            <span class="text-sm text-gray-600">还没有账户？</span>
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-500 font-medium">
                立即注册
            </a>
        </div>
    </form>
</x-guest-layout>
