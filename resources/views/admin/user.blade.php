@extends('layouts.admin')
@section('title', 'Users Management')
@section('content')
    <div class="content-wrapper" id="users-management-container">
        <div class="flex flex-wrap justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Users Management</h1>
            <button type="button"
                class="add-user-btn px-4 py-2 bg-[#2a2d47] text-white rounded-md flex items-center hover:bg-blue-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add New User
            </button>
        </div>

        <div class="bg-white rounded-lg shadow-lg mb-6">
            <div class="p-5 border-b border-gray-200">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <div class="flex">
                        <input type="text" name="search"
                            class="w-full px-4 py-3 border-2 border-[#2a2d47] rounded-l-md focus:outline-none focus:ring-1 focus:ring-[#2a2d47] text-gray-700 bg-gray-50"
                            placeholder="Search by name or email..." value="{{ request('search') }}">
                        <button type="submit"
                            class="px-4 py-3 bg-[#2a2d47] border-2 border-[#2a2d47] border-l-0 rounded-r-md hover:bg-[#3a3d57]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    @if (request('search'))
                        <div class="mt-3">
                            <a href="{{ route('admin.users.index') }}"
                                class="text-sm text-[#2a2d47] font-medium hover:underline">
                                Clear search
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        @if (session('success'))
            <div id="alert-success"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-green-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-green-700"
                        onclick="document.getElementById('alert-success').remove()">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p>{{ session('error') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-red-700"
                        onclick="document.getElementById('alert-error').remove()">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
        {{-- Table User Management --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->id }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    @if ($user->hasRole('superadmin'))
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Super Admin
                                        </span>
                                    @elseif($user->hasRole('admin'))
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Admin
                                        </span>
                                    @elseif($user->hasRole('hmif'))
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Anggota HMIF
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex justify-center space-x-3">
                                        <button type="button" data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                            data-user-role="{{ $user->roles->first()->name ?? 'user' }}"
                                            data-user-created="{{ $user->created_at->format('d M Y, H:i') }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition-colors show-user-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button type="button" data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                            data-user-role="{{ $user->roles->first()->name ?? 'user' }}"
                                            class="text-yellow-600 hover:text-yellow-900 transition-colors edit-user-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                        <button type="button" data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            class="text-red-600 hover:text-red-900 transition-colors delete-user-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-sm font-medium text-gray-500">No
                                    users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $users->firstItem() ?? 0 }}</span> to <span
                        class="font-medium">{{ $users->lastItem() ?? 0 }}</span> of <span
                        class="font-medium">{{ $users->total() }}</span> users
                </div>
                <div>
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Create User Modal -->
    <div id="userEditModalCreate"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-md transition-opacity duration-300"
        role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0 animate-modal-in">
            <!-- Modal Panel -->
            <div
                class="bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 sm:my-8 sm:max-w-lg sm:w-full transform transition-all duration-300 backdrop-blur-sm">
                <div class="px-8 pt-8 pb-6">
                    <div class="absolute top-6 right-6">
                        <button type="button"
                            onclick="document.getElementById('userEditModalCreate').classList.add('hidden')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Add New User</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8">Complete the form below to create a new user account
                    </p>
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6 text-left">
                            <div>
                                <label for="create_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full
                                    Name</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <input type="text" name="name" id="create_name" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="create_email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </span>
                                    <input type="email" name="email" id="create_email" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="create_password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 116 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <input type="password" name="password" id="create_password" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="create_password_confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm
                                    Password</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 116 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <input type="password" name="password_confirmation" id="create_password_confirmation"
                                        required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="create_role"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <select name="role" id="create_role" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200 appearance-none">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button"
                                onclick="document.getElementById('userEditModalCreate').classList.add('hidden')"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-blue-500/40 transition-all duration-200">
                                Save User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="userEditModalEdit"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-md transition-opacity duration-300"
        role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0 animate-modal-in">
            <!-- Modal Panel -->
            <div
                class="bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 sm:my-8 sm:max-w-lg sm:w-full transform transition-all duration-300 backdrop-blur-sm">
                <div class="px-8 pt-8 pb-6">
                    <div class="absolute top-6 right-6">
                        <button type="button"
                            onclick="document.getElementById('userEditModalEdit').classList.add('hidden')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Edit User</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8">Update user information and permissions</p>
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_user_id" name="id">
                        <div class="space-y-6 text-left">
                            <div>
                                <label for="edit_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full
                                    Name</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" id="edit_name" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="edit_email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                                    Address</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="edit_email" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200">
                                </div>
                            </div>

                            <div>
                                <label for="edit_role"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Role</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                        <i class="fas fa-shield-alt"></i>
                                    </span>
                                    <select name="role" id="edit_role" required
                                        class="block w-full border border-gray-200 dark:border-gray-600 rounded-xl py-3.5 pl-12 pr-4 bg-white/50 dark:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:placeholder-gray-400 sm:text-sm transition-all duration-200 appearance-none">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="hmif">Anggota HMIF</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button"
                                onclick="document.getElementById('userEditModalEdit').classList.add('hidden')"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-blue-500/40 transition-all duration-200">
                                <i class="fas fa-save mr-2"></i> Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Show User Modal -->
    <div id="userEditModalShow"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-md transition-opacity duration-300"
        role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0 animate-modal-in">
            <!-- Modal Panel -->
            <div
                class="bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 sm:my-8 sm:max-w-lg sm:w-full transform transition-all duration-300 backdrop-blur-sm">
                <div class="px-8 pt-8 pb-6">
                    <div class="absolute top-6 right-6">
                        <button type="button"
                            onclick="document.getElementById('userEditModalShow').classList.add('hidden')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">User Details</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-8">Complete user information and account details</p>

                    <div
                        class="bg-gray-50 text-left dark:bg-gray-700/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-600">
                        <div class="flex flex-col space-y-5">
                            <div class="flex items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-300 flex-shrink-0">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">User ID</div>
                                    <div class="font-medium text-gray-900 dark:text-white" id="show_user_id">1</div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center text-emerald-600 dark:text-emerald-300 flex-shrink-0">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Full Name</div>
                                    <div class="font-medium text-gray-900 dark:text-white" id="show_user_name">Admin User
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center text-purple-600 dark:text-purple-300 flex-shrink-0">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Email Address</div>
                                    <div class="font-medium text-gray-900 dark:text-white" id="show_user_email">
                                        admin@.ac.id</div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center text-amber-600 dark:text-amber-300 flex-shrink-0">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">User Role</div>
                                    <div class="font-medium text-gray-900 dark:text-white" id="show_user_role">admin</div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-rose-100 dark:bg-rose-900/50 flex items-center justify-center text-rose-600 dark:text-rose-300 flex-shrink-0">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Created At</div>
                                    <div class="font-medium text-gray-900 dark:text-white" id="show_user_created_at">09
                                        May 2025, 09:42</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="button"
                            onclick="document.getElementById('userEditModalShow').classList.add('hidden')"
                            class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                            <i class="fas fa-times mr-2"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete User Modal -->
    <div id="userEditModalDelete"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-md transition-opacity duration-300"
        role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0 animate-modal-in">
            <!-- Modal Panel -->
            <div
                class="bg-white/95 dark:bg-gray-800/95 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 sm:my-8 sm:max-w-lg sm:w-full transform transition-all duration-300 backdrop-blur-sm">
                <div class="px-8 pt-8 pb-6">
                    <div class="absolute top-6 right-6">
                        <button type="button"
                            onclick="document.getElementById('userEditModalDelete').classList.add('hidden')"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-center mb-6">
                        <div
                            class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-red-500 dark:text-red-300">
                            <i class="fas fa-trash-alt text-2xl"></i>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 text-center">Delete User</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6 text-center">Are you sure you want to delete this user?
                        This action cannot be undone.</p>

                    <div
                        class="bg-red-50 dark:bg-red-900/20 rounded-2xl p-4 border border-red-100 dark:border-red-800/30 mb-6">
                        <div class="flex items-center">
                            <div class="mr-3 text-red-500 dark:text-red-300">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <p class="text-sm text-red-600 dark:text-red-300">
                                You are about to delete <strong id="delete_user_name" class="font-semibold"></strong>
                            </p>
                        </div>
                    </div>

                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="delete_user_id" name="id">
                        <div class="flex justify-center space-x-4">
                            <button type="button"
                                onclick="document.getElementById('userEditModalDelete').classList.add('hidden')"
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500 transition-colors duration-200">
                                <i class="fas fa-ban mr-2"></i> Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 shadow-lg hover:shadow-red-500/40 transition-all duration-200">
                                <i class="fas fa-trash-alt mr-2"></i> Delete User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
