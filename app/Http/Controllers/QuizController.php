<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Test;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function quizCourse(Request $request, $courseId)
    {
        try {
            $courseQuiz = Test::with('course')->where('course_id', $courseId)->get();
            return response()->json($courseQuiz);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function registerResultat(Request $request)
    {
        try {
            $Result = new Result();
            $Result->course_id = $request->course_id;
            $Result->compte_id = $request->compte_id;
            $Result->note = $request->note;
            $Result->date = Carbon::now();
            $Result->etat = $request->etat;
            //$Result->date = Carbon::today();
            $Result->save();

            return response()->json(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
    public function findquizCourseUser(Request $request, $courseId,$compteId)
    {
        try {
            $courseQuizUser = Result::where('course_id', $courseId)
                        ->where('compte_id', $compteId)
                        ->first();
            return response()->json($courseQuizUser);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }

    public function updateResultatUse(Request $request, $courseId,$compteId)
{
    try {
        $result = Result::where('course_id', $courseId)
            ->where('compte_id',$compteId)
            ->firstOrFail(); // Use firstOrFail() to throw an exception if the record is not found

        $result->note = $request->note;
        $result->date = Carbon::now();
        $result->etat = $request->etat;
        $result->save();

        return response()->json(['message' => 'Update successful'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Update failed', 'error' => $e->getMessage()], 500);
    }
}
}
