<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashbdoard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
                <h1 class="text-2xl font-bold mb-4">Users List</h1>
                <table class="min-w-full bg-white dark:bg-gray-800">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-left">Name</th>
                            <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-left">Email</th>
                            <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Is Admin</th>
                            <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @if($user->id != auth()->user()->id)
                                <tr>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-center">{{ $user->id }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $user->name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">{{ $user->email }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-center">{{ $user->isadmin ? 'Yes' : 'No' }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-center w-auto flex justify-center space-x-4">
                                        <form method="POST" action="{{ route('deleteUser') }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                        </form>
                                        <form method="POST" action="{{ route('updateUserRole') }}">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <input type="hidden" name="new_role" value="{{ $user->isadmin ? 'user' : 'admin' }}">
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                @if($user->isadmin)
                                                    Remove Admin
                                                @else
                                                    Make Admin
                                                @endif
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
