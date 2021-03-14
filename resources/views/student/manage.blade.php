<div id="student-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Student Form</h3>
                <div class="alert alert-danger alert-messages print-error-msg" style="display:none;"><ul></ul></div>
                <div class="alert alert-success fade alert-messages print-success-msg" style="display:none;"></div>
            </div>
            
            <form id="studentForm" name="student" role="form" method="POST" action="" class="ajax-submit">
                {{ csrf_field() }}

                {!! Form::hidden('student_id', '' , ['id' => 'student_id'] ); !!}
                <div class="modal-body">				
                    <div class="form-group">
                        {!! Form::label('name', 'Name*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'name']) !!}
                        {!! Form::text('name', $student->name ?? '', ['class' => 'form-control form-control-lg mb-2', 'id' => 'name', 'placeholder'=>'Student Name']) !!}
                    </div>	
                    <div class="form-group">
                        {!! Form::label('age', 'Age*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'age']) !!}
                        {!! Form::text('age', $student->age ?? '', ['class' => 'form-control check_numeric form-control-lg mb-2', 'id' => 'age', 'placeholder'=>'Student age']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gender', 'Gender*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'gender']) !!}
                        {!! Form::radio('gender', 1, true, ['id' => 'gender-1']) !!} Male 
                        {!! Form::radio('gender', 2, '', ['id' => 'gender-2']) !!} Female 
                    </div>
                    <div class="form-group">
                        {!! Form::label('teacher_id', 'Reporting Teacher*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'age']) !!}
                        {!! Form::select('teacher_id',$page->teachers, $student->teacher_id ?? '' , ['class' => 'form-control', 'id' => 'teacher_id', 'placeholder'=>'Select Teacher']) !!}
                    </div>		
                </div>
                <div class="modal-footer">					
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success ajax-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>