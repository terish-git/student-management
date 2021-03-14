<div id="teacher-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Teacher Form</h3>
                <div class="alert alert-danger alert-messages print-error-msg" style="display:none;"><ul></ul></div>
                <div class="alert alert-success fade alert-messages print-success-msg" style="display:none;"></div>
            </div>
            
            <form id="teacherForm" name="teacher" role="form" method="POST" action="" class="ajax-submit">
                {{ csrf_field() }}

                {!! Form::hidden('teacher_id', '' , ['id' => 'teacher_id'] ); !!}
                <div class="modal-body">				
                    <div class="form-group">
                        {!! Form::label('name', 'Name*', ['class' => 'col-sm-2 col-form-label text-alert', 'id' => 'name']) !!}
                        {!! Form::text('name', $teacher->name ?? '', ['class' => 'form-control form-control-lg mb-2', 'id' => 'teacher_name', 'placeholder'=>'Teacher Name']) !!}
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