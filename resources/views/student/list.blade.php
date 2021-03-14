@extends('layouts.app')
 
@section('content')
  <h3>Student management System</h3>

  <div class="page-header">

    <div class="pull-right">
    <h3 class="text-right"><button type="button" class="btn btn-info btn" onclick="manageStudent(null)">Add Student</button></h3>
    </div>
    <div class="clearfix"></div>
</div>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Reporting Teacher</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
      <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{$student->name}}</td>
        <td>{{$student->age}}</td>
        <td>{!! ($student->gender == "1" ? 'Male' : 'Female') !!}</td>
        <td>{{ $student->teacher->name }}</td>
        <td width="20%">
        <button type="button" class="btn btn-sm btn-info btn" onclick="manageStudent({{$student->id}})">Edit</button>
        <button type="button" class="btn btn-sm btn-danger btn" onclick="deleteStudent({{$student->id}})">Delete</button>
        </td>
      </tr>
    @endforeach

    </tbody>
  </table>

@include('student.manage') 
@endsection
@push('page-scripts')
<script src="{{ asset('js/ajax-crud.js') }}"></script>

<script type="text/javascript">

function manageStudent(student_id){
    if (student_id === null) {
            $("#studentForm")[0].reset();
            $('#studentForm').find("input[type=text]").val("");
            $("#teacher_id").val($("#teacher_id option:first").val());
            $("#student_id").val('');
            $("#student-modal").modal("show");
        } else {
            $.ajax({url: "{{ url('students/') }}/" + student_id + "/edit", type: "GET", dataType: "html"})
                .done(function (a) {
                    var data = JSON.parse(a);
                    if(data.flagError == false){
                        $("#student_id").val(data.data.id);
                        $("#studentForm input[name=name]").val(data.data.name);
                        $("#studentForm input[name=age]").val(data.data.age);
                        $("#gender-"+data.data.gender).attr('checked', true);
                        $("#teacher_id > [value=" + data.data.teacher_id + "]").attr("selected", "true");
                        $("#student-modal").modal("show");
                    }
                }).fail(function () {
                    printErrorMsg("Please try again...", "error");
            });
        }
}

function deleteStudent(teacher_id){
    swal({title: "Are you sure?", icon: "warning",buttons: true,dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        $.ajax({url: "{{ url('students/') }}/" + teacher_id, type: "DELETE", dataType: "html"})
                .done(function (a) {
                    var data = JSON.parse(a);
                    if(data.flagError == false){
                        swal("Deleted Successfully!");
                        setTimeout(function () { location.reload();}, 2000);
                    }
                }).fail(function () {
                    printErrorMsg("Please try again...", "error");
            });
    } 
    });





            

}

$("body").on("submit", ".ajax-submit", function (e) {
    e.preventDefault();
    id = $("#student_id").val();
    studentId   = "" == id ? "" : "/" + id;
    formMethod  = "" == id ? "POST" : "PUT";
    var forms = $("#studentForm");
    $.ajax({ url: "{{ url('students') }}" + studentId, type: formMethod,processData: false, 
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