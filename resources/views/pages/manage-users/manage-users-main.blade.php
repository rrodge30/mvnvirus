@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row">
            <h3 class="brand col-md-10">Users Settings</h3>
            <a href="{{route('register')}}" class="btn btn-success col-md-2" data-toggle="tooltip" title="Add User">
                <i class="material-icons">person_add</i>
            </a>
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <table id="user_table" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Username</th>
                    <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    @if($users && count($users) > 0)
                        
                        @foreach($users as $key => $value)
                            <tr>
                                <th class="text-center" scope="row">{{$key+1}}</th>
                                <td class="text-center">{{$value->username}}</td>
                            <td class="text-center"><button data-id="{{$value->id}}" class="btn btn-danger btn-delete-user" href="#"><i class="material-icons">delete</i></button></td>
                            </tr>
                        
                        @endforeach
                        
                    @endif
                    
                </tbody>
            </table>
        </div> 
    </div>
    <div class="col-md-2">
        
    </div>
</div>
  
    
{{-- SCRIPT --}}
<script>
    $(document).ready(function(){
        $('#user_table').dataTable();
        $(document).on('click','button.btn-delete-user',function(e){
            e.preventDefault();
            var btn = $(this);
            var id = btn.data('id');
            swal({
            title: "Are You Sure?",
            text: "Do You Want to Delete This Record ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false,
            },
            function(isConfirm){
                if (isConfirm) {
                    var url = '{{ route("user.manage.delete", ":id") }}';

                    url = url.replace(':id', id);

                    window.location.href=url;
                
                }else{
                    swal("Cancelled", "Delete Canceled.", "error"); 
                }
            });

        });


    });


//


</script>
{{-- END SCRIPT --}}
@endsection
