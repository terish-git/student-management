@extends('layouts.app')
 
@section('content')
  <h3>Student management System</h3>

  <div class="page-header">

    <div class="pull-right">
    <h3 class="text-right"><button type="button" class="btn btn-info btn" onclick="manageMark(null)">Add Marks</button></h3>
    </div>
    <div class="clearfix"></div>
</div>



  <table class="table table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Maths</th>
        <th>Science</th>
        <th>History</th>
        <th>Term</th>
        <th>Total Marks</th>
        <th>Created On</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($marks as $mark)
        <tr>
          <td>{{ $loop->index+1 }}</td>
          <td>{{$mark->name}}</td>
          <td>{{$mark->maths}}</td>
          <td>{{$mark->science}}</td>
          <td>{{$mark->history}}</td>
          <td>{{$mark->term}}</td>
          <td>{{$mark->total_mark}}</td>
          <td>{{$mark->created_at->format('M d , yy')}}</td>
          <td width="20%">
          <button type="button" class="btn btn-sm btn-info btn" onclick="manageMark({{$mark->id}})">Edit</button>
          <button type="button" class="btn btn-sm btn-danger btn" onclick="deleteMark({{$mark->id}})">Delete</button>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>

@include('mark.manage') 
@endsection
@push('page-scripts')
<script src="{{ asset('js/ajax-crud.js') }}"></script>

<script type="text/javascript">

function manageMark(mark_id){
    if (mark_id === null) {
            $("#markForm")[0].reset();
            $('#markForm').find("input[type=text]").val("");
            $("#student_id").val($("#student_id option:first").val());
            $("#mark_id").val('');
            $("#mark-modal").modal("show");
        } else {
            $.ajax({url: "{{ url('marks/') }}/" + mark_id + "/edit", type: "GET", dataType: "html"})
                .done(function (a) {
                    var data = JSON.parse(a);
                    if(data.flagError == false){
                        $("#mark_id").val(data.data.id);
                        $("#student_id > [value=" + data.data.student_id + "]").attr("selected", "true");
                        $("#term > [value=" + data.data.term + "]").attr("selected", "true");
                        $("#markForm input[name=maths]").val(data.data.maths);
                        $("#markForm input[name=science]").val(data.data.science);
                        $("#markForm input[name=history]").val(data.data.history);
      
                        $("#mark-modal").modal("show");
                    }
                }).fail(function () {
                    printErrorMsg("Please try again...", "error");
            });
        }
}

function deleteMark(teacher_id){
    swal({title: "Are you sure?", icon: "warning",buttons: true,dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
        $.ajax({url: "{{ url('marks/') }}/" + teacher_id, type: "DELETE", dataType: "html"})
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
    id = $("#mark_id").val();
    markId   = "" == id ? "" : "/" + id;
    formMethod  = "" == id ? "POST" : "PUT";
    var forms = $("#markForm");
    $.ajax({ url: "{{ url('marks') }}" + markId, type: formMethod,processData: false, 
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