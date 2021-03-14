<?php

namespace App\Http\Controllers;
   
use App\Models\Teacher;
use Illuminate\Http\Request;
use Validator;
  
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = collect();
        $page->title    = "All Teachers";
        $teachers       = Teacher::all();
        return view('teacher.list',compact('teachers', 'page'));
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.list');
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
        ]);

    
        if ($validator->passes()) {
            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->save();
            return ['flagError' => false, 'message' => "Added successfully"];
        }
        return ['flagError' => true, 'error'=>$validator->errors()->all()];
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('teacher.show',compact('teacher'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        if($teacher){
            return ['flagError' => false, 'data' => $teacher];
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
        ]);
        if ($validator->passes()) {
            $teacher = Teacher::findOrFail($id);
            if($teacher){
                $teacher->name = $request->name;
                $teacher->save();
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
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $teacher = Teacher::with('student')->findOrFail($id);

        if( isset($teacher->student)){
            return ['flagError' => true, 'message' => "There are student reporting to this teacher"];
        }else{
            $teacher->delete();
            return ['flagError' => false, 'message' => "Deleted successfully"];
        }
        
    }
}