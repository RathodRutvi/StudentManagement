@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
            <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModal">
                Add Student Marks
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Student Name</label>

                                <div class="input-group mb-3">

                                    <select class=" student_id custom-select" name="student_id" id="inputGroupSelect01">
                                        <option selected>Choose...</option>
                                        @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">English Mark</label>
                                <input type="number" name="english" class="english form-control" id=""
                                    placeholder="Enter English Mark">
                            </div>
                            <div class="form-group">
                                <label for="">Hindi Mark</label>
                                <input type="number" name="hindi" class="hindi form-control" id=""
                                    placeholder="Enter Hindi Mark">
                            </div>
                            <div class="form-group">
                                <label for="">Gujarati Mark</label>
                                <input type="number" name="gujarati" class="gujarati form-control" id=""
                                    placeholder="Enter Gujarati Mark">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="submit btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <!-- Button trigger modal -->


                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
$(function() {

    $(document).on("click", ".submit", function() {
        var student_id = $('.student_id').val();
        var english = $(".english").val();
        var hindi = $(".hindi").val();
        var gujarati = $(".gujarati").val();

        $.ajax({
            type: "post",
            url: "{{route('student.store')}}",
            data: {
                student_id: student_id,
                english: english,
                hindi: hindi,
                gujarati: gujarati,
                _token: "{{csrf_token()}}",
            },
            dataType: "json",
            success: function(data) {
                $("#exampleModal .close").click();
                
                showdata();
            }
        });

    })

    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        event.preventDefault();
        swal({
                title: `Are you sure you want to delete this record?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "{{route('student.delete')}}",
                        data: {
                            id: id,
                            _token: "{{csrf_token()}}",
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "true") {
                                showdata();
                            }

                        }
                    });
                }
            });
    })

    

    showdata();

    function showdata() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{ route('student.index') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        return table;
    }



});
</script>
@endsection