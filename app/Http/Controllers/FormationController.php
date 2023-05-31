<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Objective;
use App\Models\Comment;

class FormationController extends Controller
{
    public function index()
    {
        $formation = Formation::with('category')->get();
        return response()->json($formation);
    }
    public function formation(Request $request, $formationId)
    {
        try {
            $formation = Formation::with('category')->findOrFail($formationId);
            return response()->json($formation);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }

    public function objectFormation(Request $request, $objectiveId)
    {
        try {
            $courseObjct = Objective::with('formation')->where('formation_id', $objectiveId)->get();
            return response()->json($courseObjct);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function CommentFormation(Request $request, $formationId)
    {
        try {
            $Commentcourse = Comment::with('formation','user')->where('formation_id', $formationId)->get();
            return response()->json($Commentcourse);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch user courses'], 500);
        }
    }
    public function registerCommentsFor(Request $request)
    {
        try {
            $Comment = new Comment();
            $Comment->content = $request->content;
            $Comment->rating = $request->rating;
            $Comment->course_id = null;
            $Comment->compte_id = $request->compte_id;
            $Comment->formation_id = $request->formation_id;
            $Comment->save();

            return response()->json(['message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
}
