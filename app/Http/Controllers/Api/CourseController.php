<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    
    public function index()
    {
        $course = Course::all();
        return response()->json([
            'success' => true,
            'message' => 'Courses fetched successfully',
            'data' => $course
        ],201);
    }

    
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        $course = Course::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'course' => $course,
        ], 201);
    }

    
    public function show(Course $course)
    {
        return response()->json([
            'success' =>true,
            'message' => 'Course fetched successfully',
            'data' => $course
        ],200);
    }

    
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();
        $course->update($data);
        return response()->json([
            'success' =>true,
            'message' => "Course Updated Successfully",
            'course' => $course->fresh(),
        ], 200);
    }

    public function patch(UpdateCourseRequest $request, Course $course){
        $data = $request->validated();
        $course->update($data);
        return response()->json([
            'success' =>true,
            'message' => "Course Updated Successfully",
            'course' => $course->fresh(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->enrollments()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Delete course enrollment first',
            ], 409);
        }
        $course->delete();
        return response()->json([
            'success' => true,
            'message' => 'Course Deleted Successfully',
        ], 200);
    }
}
