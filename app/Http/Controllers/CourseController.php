<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $isAdmin = $user->isadmin;

        if ($isAdmin) {
            $courses = Course::with('users')->get();
        } else {
            $enrolledCourses = $user->courses->pluck('id');
            $courses = Course::whereNotIn('id', $enrolledCourses)->with('users')->get();
        }

        return view($isAdmin ? 'admin.dashboard' : 'users.dashboard', compact('courses', 'isAdmin'));
    }




    public function addCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required',
        ]);

        $course = new Course();
        $course->name = $request->input('course_name');
        $course->description = $request->input('description');
        $course->image_url = $request->input('image_url');
        $course->save();

        return redirect()->route('dashboard')->with('success', 'Course created successfully!');
    }

    public function enrollCourse(Request $request, Course $course)
    {
        $user_id = auth()->user()->id;
        if (!$course->users()->where('user_id', $user_id)->exists()) {
            $course->users()->attach($user_id);
            $course->increment('members_count');
        }

        return redirect()->route('courses')->with('success', 'You have enrolled in the course successfully!');
    }



    public function leaveCourse(Request $request, Course $course)
    {
        $user_id = auth()->user()->id;
        if ($course->users()->where('user_id', $user_id)->exists()) {
            $course->users()->detach($user_id);
            $course->decrement('members_count');
            return redirect()->route('dashboard')->with('success', 'You have successfully left the course!');
        }
        return redirect()->route('dashboard')->with('error', 'You are not enrolled in this course.');
    }


    public function updateCourse(Request $request)
    {
        $validatedData = $request->validate([
            'courseName' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|string|url',
        ]);

        $course = Course::findOrFail($request->courseId);

        $course->name = $validatedData['courseName'];
        $course->description = $validatedData['description'];
        $course->image_url = $validatedData['image_url'];
        $course->save();

        $subscribedUsers = $course->users;

        return redirect()->route('courses')->with('success', 'Course updated successfully');
    }



    public function deleteCourse(Request $request)
    {
        $courseId = $request->input('course_id');
        $course = Course::find($courseId);

        if ($course) {
            $course->delete();
            return redirect('dashboard')->with('success', 'Course deleted successfully!');
        } else {
            return redirect('dashboard')->with('error', 'Course not found!');
        }
    }


    public function myCourses()
    {
        $user = Auth::user();
        $isAdmin = $user->isadmin;

        if ($isAdmin) {
            $courses = Course::all();
            return view('admin.dashboard', compact('courses', 'isAdmin'));
        } else {
            $courses = $user->courses;
            return view('users.courses', compact('courses', 'isAdmin'));
        }
    }
}
