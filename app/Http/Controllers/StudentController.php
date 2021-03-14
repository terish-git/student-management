<?php

namespace App\Http\Controllers;
   
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Mark;
use Illuminate\Http\Request;
use Validator;
  
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = collect();
        $students = Student::with('teacher')->get();
        $page->title    = "All Student";
        $page->teachers       = Teacher::pluck('name','id');
        return view('student.list',compact('students','page'));
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.list');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'teacher_id' => 'required',
        ]);

    
        if ($validator->passes()) {
            $student = new Student();
            $student->name = $request->name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->teacher_id = $request->teacher_id;
            $student->save();
            return ['flagError' => false, 'message' => "Added successfully"];
        }
        return ['flagError' => true, 'error'=>$validator->errors()->all()];
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('student.show',compact('product'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        if($student){
            return ['flagError' => false, 'data' => $student];
        }else{
            return ['flagError' => true, 'message' => "Data not found, Try again!"];
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'teacher_id' => 'required',
        ]);


        if ($validator->passes()) {
            $student = Student::findOrFail($id);
            if($student){
                $student->name = $request->name;
                $student->age = $request->age;
                $student->gender = $request->gender;
                $student->teacher_id = $request->teacher_id;
                $student->save();
                return ['flagError' => false, 'message' => "Updated successfully"];
            }else{
                return ['flagError' => true, 'message' => "Data not found, Try again!"];
            }
        }
        return ['flagError' => true, 'error'=>$validator->errors()->all()];
            
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        $mark = Mark::where('student_id',$id)->delete();

        return ['flagError' => false, 'message' => "Deleted successfully"];
    }
}