<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-full ">
                <div class="container p-4 w-3/4">
                    <div class="p-4">
                        <h1 class="text-2xl font-bold mb-4">Create a new course</h1>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="newCourse()">New Course</button>
                    </div>
                </div>


                <script>
                    function newCourse() {
                        document.getElementById('newCourse').style.display = 'block';
                    }

                    function closeModal() {
                        document.getElementById('newCourse').style.display = 'none';
                    }
                </script>

                <div class="fixed z-10 inset-0 overflow-y-auto" style="display: none;" id="newCourse">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-1/2">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 w-full">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">New Course</h3>
                            <div class="mt-2">
                                <form class="" method="POST" action="{{ route('addCourse') }}" id='courseForm'>
                                    @csrf
                                    <div class="mb-4">
                                        <label for="course_name" class="block text-gray-700 text-sm font-bold mb-2">Course Name:</label>
                                        <input type="text" id="course_name" name="course_name" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500" placeholder="Enter course name">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                                        <textarea id="description" name="description" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500" rows="4" placeholder="Enter course description"></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">Image URL:</label>
                                        <input type="text" id="image_url" name="image_url" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500" placeholder="Enter image URL">
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Course</button>
                                    <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Close</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($courses as $course)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{$course->image_url}}" alt="{{ $course->name }}" class="w-full h-64 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-bold mb-2">{{ $course->name }}</h2>
                                <p class="text-gray-700 mb-2 max-h-20">{{ $course->description}}</p>
                                <div class="flex items-center mb-4">
                                    <span class="text-yellow-500">★ ★ ★ ★ ☆</span>
                                    <span class="ml-2 text-gray-600">({{$course->rating}}/5)</span>
                                </div>
                                <p class="text-gray-700 mb-2">Members Count: {{ $course->members_count }}</p>
                                <div class="grid grid-cols-2 space-x-5 px-2">
                                    <button onclick="openEditModal({{ $course->id }}, '{{ $course->name }}', '{{ $course->description }}', '{{ $course->image_url }}')" class="bg-green-500 text-white w-full px-4 py-2 rounded hover:bg-green-600">Edit</button>
                                    <form method="POST" action="{{ route('deleteCourse') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <button type="submit" class="bg-red-500 text-white w-full px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="editModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-1/2" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 w-full">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">Edit Course</h3>
                            <div class="mt-2">
                                <form id="editForm" method="POST" action="{{ route('updateCourse') }}">
                                    @csrf
                                    <input type="hidden" id="courseId" name="courseId">
                                    <div>
                                        <label for="courseName" class="block text-sm font-medium text-gray-700">Course Name</label>
                                        <input type="text" name="courseName" id="courseName1" autocomplete="off" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="mt-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <input type="text" name="description" id="description1" autocomplete="off" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="mt-4">
                                        <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                                        <input type="text" name="image_url" id="image_url1" autocomplete="off" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">Save Changes</button>
                                        <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(courseId, courseName, description, imageUrl) {
            document.getElementById('courseId').value = courseId;
            document.getElementById('courseName1').value = courseName;
            document.getElementById('description1').value = description;
            document.getElementById('image_url1').value = imageUrl;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</x-app-layout>
