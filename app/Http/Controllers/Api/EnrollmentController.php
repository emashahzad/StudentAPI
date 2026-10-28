<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollment = Enrollment::with(['student','course'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Enrollments fetched successfully',
            'data' => $enrollment,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentRequest $request)
    {
        $data = $request->validated();
        $enrollment = Enrollment::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Enrollment Created Successfully',
            'data' => $enrollment->load(['student', 'course'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return response()->json([
            'status' => true,
            'message' => 'Enrollment fetched successfully',
            'data' => $enrollment->load(['student','course']),
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $data = $request->validated();
        $studentId = $data['student_id'] ?? $enrollment->student_id;
        $courseId = $data['course_id'] ?? $enrollment->course_id;
        $duplicate = Enrollment::where('student_id', $studentId)->where('course_id', $courseId)->where('id', '!=', $enrollment->id)->exists();
        if ($duplicate) {
            return response()->json([
                'status' => false,
                'message' => 'student already enrolled in this course'
            ], 409);
        }
        $enrollment->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Enrollment Updated Successfully',
            'data' => $enrollment->fresh()->load(['student', 'course'])
        ], 200);
    }

    public function patch(Request $request, Enrollment $enrollment)
    {
        $data = $request->validated();
        $enrollment->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Enrollment Updated Successfully',
            'data' => $enrollment->load(['student', 'course'])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return response()->json([
            'status' => true,
            'message' => 'Enrollment Deleted Successfully'
        ], 200);
    }
}
