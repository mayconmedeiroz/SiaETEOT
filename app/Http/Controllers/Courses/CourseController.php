<?php

namespace App\Http\Controllers\Courses;

use App\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validator(Request $request){

        return Validator::make($request->all(), [

            'courseName' => ['required', 'string', 'max:255'],
            'courseWorkload' => ['required', 'string', 'size:4'] 

            ]);

    }



    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = $this->validator($request);


        if ($error->fails()) {

            return response()->json([
                "error" => true,
                "message" => $error->errors()->all()
            ], 400);

    }

    Course::create([

        "course_name" => $request->courseName,
        "course_workload" => $request->courseWorkload

    ]);

    return response()->json([

        "error" => false,
        "message" => ["Course Created"]

    ], 201);

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $error = $this->validator($request);

        if ($error->fails()) {

            return response()->json([

                "error" => true,
                "message" => $error->errors()->all()

            ], 400);

        }

        $course->update([
            "course_name" => $request->courseName,
            "course_workload" => $request->courseWorkload
        ]);

        return [
            "error" => false,
            "userId" => $id
        ];

    }
        

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if (isset($course)) {

            $course->delete();

            return response()->json([
                "error" => false,
                "message" => ["Course deleted"]
            ],200);

        }

        return response()->json([
            "error" => true,
            "message" => ["Error when deleting Course"]
        ], 400);

    }
}