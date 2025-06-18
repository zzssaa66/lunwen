<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo 等 -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- 你的 Logo -->
                        <x-application-logo class="block h-10 w-auto" />
                    </a>
                </div>
                <!-- 导航链接 -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @role('author')
                            <x-nav-link :href="route('papers.index')" :active="request()->routeIs('papers.*')">
                                我的论文
                            </x-nav-link>
                        @endrole

                        @role('reviewer')
                            <x-nav-link :href="route('reviewer.papers.index')" :active="request()->routeIs('reviewer.papers.*')">
                                待评审论文
                            </x-nav-link>
                        @endrole

                        @role('admin')
                            <x-nav-link :href="route('admin.papers.index')" :active="request()->routeIs('admin.papers.*')">
                                论文管理
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                用户管理
                            </x-nav-link>
                        @endrole
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- 通知图标（可选，若实现站内通知） -->
                <!-- 用户下拉 -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center ...">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" ...>...</svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Profile, Logout 等 -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                退出登录
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <!-- 移动端汉堡菜单 -->
                <button @click="open = ! open" ...>...</button>
            </div>
        </div>
    </div>
    <!-- 移动端菜单内容 -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- 类似上方链接，带角色判断 -->
    </div>
</nav>