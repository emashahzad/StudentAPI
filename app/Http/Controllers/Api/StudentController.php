<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        return response()->json([
            'success' => true,
            'message' => 'Students fetched Successfully',
            'data' => $student,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        if ($request->hasfile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }
        $student = Student::create($data);
        return response()->json([
            'success' => true,
            'message' => 'Student Created Successfully',
            'data' => $student,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json([
            'success' => true,
            'message' => 'Student fetched Successfully',
            'data' => $student,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();

        if ($request->hasfile('profile_image')) {
            $oldImage = $student->profile_image;
            $data['profile_image'] = $request->file('profile_image')->store('students', 'public');
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($data['profile_image']);
        }
        $student->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $student->fresh()
        ], 200);
    }

    public function patch(UpdateStudentRequest $request, Student $student)
    {

        $data = $request->validated();
        $student->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully',
            'data' => $student->fresh()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->enrollments()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Delete student enrollments first'
            ], 409);
        }
        $image = $student->profile_image;
        $student->delete();
        if ($image) {
            Storage::disk('public')->delete($image);
        }
        return response()->json([
            'success' => true,
            'message' => 'Student Deleted Successfully'
        ], 200);
    }
}
