<div id="mark-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Mark Form</h3>
                <div class="alert alert-danger alert-messages print-error-msg" style="display:none;"><ul></ul></div>
                <div class="alert alert-success fade alert-messages print-success-msg" style="display:none;"></div>
            </div>
            
            <form id="markForm" name="student" role="form" method="POST" action="" class="ajax-submit">
                {{ csrf_field() }}

                {!! Form::hidden('mark_id', '' , ['id' => 'mark_id'] ); !!}
                <div class="modal-body">				
                    <div class="form-group">
                        {!! Form::label('student_id', 'Student*', ['class' => 'col-sm-2 col-form-label text-alert']) !!}
                        {!! Form::select('student_id', $page->students, $mark->student_id ?? '' , ['class' => 'form-control', 'id' => 'student_id', 'placeholder'=>'Select Student']) !!}
                    </div>	
                    <div class="form-group">
                        {!! Form::label('term', 'Term*', ['class' => 'col-sm-2 col-form-label text-alert']) !!}
                        {!! Form::select('term', ['One' => 'One', 'Two' => 'Two'] , '', ['class' => 'form-control ', 'id' => 'term', 'style' => 'width:100%','placeholder'=>'Select term']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('maths', 'Maths*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'maths']) !!}
                        {!! Form::text('maths', $mark->maths ?? '', ['class' => 'form-control form-control-lg mb-2 check_numeric', 'id' => 'maths', 'placeholder'=>'Maths Mark']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('science', 'Science*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'science']) !!}
                        {!! Form::text('science', $mark->science ?? '', ['class' => 'form-control form-control-lg mb-2 check_numeric', 'id' => 'science', 'placeholder'=>'Science Mark']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('history', 'History*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'history']) !!}
                        {!! Form::text('history', $mark->history ?? '', ['class' => 'form-control form-control-lg mb-2 check_numeric', 'id' => 'history', 'placeholder'=>'History Mark']) !!}
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