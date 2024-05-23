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
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($courses as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{$course->image_url}}" alt="{{ $course->name }}" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-bold mb-2">{{ $course->name }}</h2>
                                <p class="text-gray-700 mb-2">{{ $course->description }}</p>
                                <div class="flex items-center mb-4">
                                    <span class="text-yellow-500">★ ★ ★ ★ ☆</span>
                                    <span class="ml-2 text-gray-600">({{$course->rating}}/5)</span>
                                </div>
                                <p class="text-gray-700 mb-2">Members Count: {{ $course->members_count }}</p>
                                <form action="{{ route('enrollCourse', ['course' => $course->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enroll Now</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
