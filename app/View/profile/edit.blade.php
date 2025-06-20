<!-- resources/views/profile/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            个人资料
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- 更新个人信息 -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">姓名</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">邮箱</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">更新资料</button>
                </form>
            </div>

            <!-- 更新密码 -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">当前密码</label>
                        <input id="current_password" name="current_password" type="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('current_password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">新密码</label>
                        <input id="password" name="password" type="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">确认新密码</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">更新密码</button>
                </form>
            </div>

            <!-- 删除账号 -->
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">当前密码（用于确认删除）</label>
                        <input id="password" name="password" type="password"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">删除账号</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>