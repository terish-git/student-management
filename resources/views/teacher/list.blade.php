@extends('layouts.app')
 
@section('content')
  <h3>Student management System</h3>

  <div class="page-header">

    <div class="pull-right">
    <h3 class="text-right"><button type="button" class="btn btn-info btn" onclick="manageTeacher(null)">Add Teacher</button></h3>
    </div>
    <div class="clearfix"></div>
</div>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
      <tr>
        <td>{{$teacher->name}}</td>
        <td width="20%">
        <button type="button" class="btn btn-sm btn-info btn" onclick="manageTeacher({{$teacher->id}})">Edit</button>
        <button type="button" class="btn btn-sm btn-danger btn" onclick="deleteTeacher({{$teacher->id}})">Delete</button>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

@include('teacher.manage') 
@endsection
@push('page-scripts')
<script src="{{ asset('js/ajax-crud.js') }}"></script>

<script type="text/javascript">

function manageTeacher(teacher_id){
    if (teacher_id === null) {
            $("#teacherForm")[0].reset();
            $('#teacherForm').find("input[type=text]").val("");
            $("#teacher_id").val('');
            $("#teacher-modal").modal("show");
        } else {
            $.ajax({url: "{{ url('teachers/') }}/" + teacher_id + "/edit", type: "GET", dataType: "html"})
                .done(function (a) {
                    var data = JSON.parse(a);
                    if(data.flagError == false){
                        $("#teacher_name").val(data.data.name);
                        $("#teacher_id").val(data.data.id);
                        $("#teacher-modal").modal("show");
                    }
                }).fail(function () {
                    printErrorMsg("Please try again...", "error");
            });
        }
}

function deleteTeacher(teacher_id){
    swal({title: "Are you sure?", icon: "warning",buttons: true,dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        $.ajax({url: "{{ url('teachers/') }}/" + teacher_id, type: "DELETE", dataType: "html"})
                .done(function (a) {
                    var data = JSON.parse(a);
                    if(data.flagError == false){
                        swal("Deleted Successfully!");
                        setTimeout(function () { location.reload();}, 2000);
                    }else{
                      swal({
                        text: data.message,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        });
                    }
                }).fail(function () {
                    printErrorMsg("Please try again...", "error");
            });
    } 
    });





            

}

$("body").on("submit", ".ajax-submit", function (e) {
    e.preventDefault();
    id = $("#teacher_id").val();
    teacherId   = "" == id ? "" : "/" + id;
    formMethod  = "" == id ? "POST" : "PUT";
    var forms = $("#teacherForm");
    $.ajax({ url: "{{ url('teachers') }}" + teacherId, type: formMethod,processData: false, 
    data: forms.serialize(), dataType: "html",
    }).done(function (a) {
        var data = JSON.parse(a);
        if(data.flagError == false){
            showSuccessMsg(data.message);
            setTimeout(function () { location.reload();}, 1000);
        }else{
            printErrorMsg(data.error);
        }
    });       
}); 


       
</script>

@endpush