<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Objective;
use App\Models\Purchased_courses;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('category')->get();
        return response()->json($courses);
    }

    public function coursesAcheter(Request $request, $userId)
    {
        try {
        $perPage = $request->query('perPage', 12);
        $filter = $request->query('filter');

        $purchasedCourses = Purchased_courses::where('compte_id', $userId)
            ->with('course.category'); // Eager load the associated course and its category


        // Apply filtering based on the selected filter option
        switch ($filter) {
            case 'new_courses':
                $purchasedCourses->orderBy('created_at', 'desc');
                break;
            case 'last_courses':
                $purchasedCourses->orderBy('created_at', 'asc');
                break;
            // Add more cases for other filter options if needed
            default:
                // No specific filtering, use default ordering or other logic
                break;
        }

        $paginatedCourses = $purchasedCourses->paginate($perPage);

        return response()->json($paginatedCourses);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch user courses'], 500);
    }
    }
    public function course(Request $request, $courseId)
    {
        try {
            $course = Course::with('category','user')->findOrFail($courseId);
            return response()->json($course);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function objectCourses(Request $request, $objectiveId)
    {
        try {
            $courseObjct = Objective::with('course')->where('course_id', $objectiveId)->get();
            return response()->json($courseObjct);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }

    public function videoCourses(Request $request, $courseId)
    {
        try {
            $courseVideo = Video::with('course')->where('course_id', $courseId)->get();
            return response()->json($courseVideo);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function CommentCourses(Request $request, $courseId)
    {
        try {
            $Commentcourse = Comment::with('course','user')->where('course_id', $courseId)->get();
            return response()->json($Commentcourse);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function registerComments(Request $request)
    {
        try {
            $Comment = new Comment();
            $Comment->content = $request->content;
            $Comment->rating = $request->rating;
            $Comment->course_id = $request->course_id;
            $Comment->compte_id = $request->compte_id;
            $Comment->formation_id = null;
            $Comment->save();

            return response()->json(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function CommentCoursesMoyn(Request $request, $courseId)
    {
        try {
            $CommentcourseRat = Comment::where('course_id', $courseId)->avg('rating');
            return response()->json($CommentcourseRat);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function updateCourseRat(Request $request, $courseId)
    {
        try {
            $course = Course::find(1)
                ->firstOrFail(); // Use firstOrFail() to throw an exception if the record is not found

            $course->rating = $request->rating;
            $course->save();

            return response()->json(['message' => 'Update successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed', 'error' => $e->getMessage()], 500);
        }
    }
}
