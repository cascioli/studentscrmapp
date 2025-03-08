<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $courses = $student->courses;

        return response()->json($courses);
    }
}
