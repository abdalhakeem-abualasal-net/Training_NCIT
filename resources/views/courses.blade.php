<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashbdoard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Subscribed Courses</h1>
                    <div class="grid grid-cols-1  gap-4">
                        <!-- Course 1 -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex h-72">
                            <img src="https://rooman.net/wp-content/uploads/2021/11/python-programing-banner.jpg" alt="Course Image" class="w-1/3 rounded-l-lg">
                            <div class="p-4 w-2/3">
                                <h2 class="text-xl font-bold mb-2">Python Programming</h2>
                                <p class="text-gray-700 mb-2">Course description goes here.</p>
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-yellow-500">★ ★ ★ ★ ☆</span>
                                        <span class="ml-2 text-gray-600">(4.5/5)</span>
                                    </div>
                                    <div class="text-gray-700">
                                        <span>Members: 100</span>
                                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-4">Unsubscribe</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
