@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        用户管理
    </h2>
@endsection

@section('content')
<div class="py-6">
  <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
      @endif
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">姓名</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">邮箱</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">角色</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($users as $u)
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $u->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $u->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $u->email }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              {{ $u->getRoleNames()->join(', ') ?: '无' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <!-- 角色更新表单 -->
              <form method="POST" action="{{ route('admin.users.updateRole', $u) }}" class="flex space-x-2">
                @csrf
                <select name="role" class="border-gray-300 rounded">
                  <option value="">选择操作</option>
                  <option value="author">赋予 Author</option>
                  <option value="reviewer">赋予 Reviewer</option>
                  <option value="admin">赋予 Admin</option>
                  <option value="remove_reviewer">移除 Reviewer</option>
                  <option value="remove_admin">移除 Admin</option>
                </select>
                <button type="submit" class="px-2 py-1 bg-blue-600 text-white rounded">提交</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4">{{ $users->links() }}</div>
    </div>
  </div>
</div>
@endsection