<?php

namespace App\Http\Controllers;
   
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Mark;
use Illuminate\Http\Request;
use Validator;
use DB;
  
class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = collect();
        $page->title    = "Student Marks";
        $page->students = Student::pluck('name','id');
        $marks          = Student::rightjoin('marks', 'marks.student_id', '=', 'students.id')
                            ->select('students.name', 'marks.id' ,'marks.maths', 'marks.science', 'marks.history', 'marks.term',
                            DB::raw('sum(marks.maths+marks.science+marks.history) AS total_mark'), 'marks.created_at')
                            ->groupBy('students.name' ,'marks.maths', 'marks.science', 'marks.history', 'marks.term', 'marks.created_at', 'marks.id')
                            ->get();
        return view('mark.list',compact('page', 'marks'));
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mark.list');
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
            'student_id' => 'required',
            'term' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required',
        ]);

    
        if ($validator->passes()) {
            $mark = new Mark();
            $mark->student_id = $request->student_id;
            $mark->term = $request->term;
            $mark->maths = $request->maths;
            $mark->science = $request->science;
            $mark->history = $request->history;
            $mark->save();
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
    public function show(Mark $mark)
    {
        return view('mark.show',compact('product'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $mark = Mark::findOrFail($id);
        if($mark){
            return ['flagError' => false, 'data' => $mark];
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
            'student_id' => 'required',
            'term' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required',
        ]);


        if ($validator->passes()) {
            $mark = Mark::findOrFail($id);
            if($mark){
                $mark->student_id = $request->student_id;
                $mark->term = $request->term;
                $mark->maths = $request->maths;
                $mark->science = $request->science;
                $mark->history = $request->history;
                $mark->save();
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
        $mark = Mark::findOrFail($id);
        $mark->delete();
        return ['flagError' => false, 'message' => "Deleted successfully"];
    }
}