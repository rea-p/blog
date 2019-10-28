
@extends ('layouts.app')
 
@section ('content')

    <h1 style="text-align:center">Welcome to the Employee Portal!</h1>
    <p style="text-align:center" > Here is the portal. </p>
    <h1 style="text-align:center" > Users </h1>
    
    <div>
        <div class="container">
            <table class="table table-bordered hover order-column" id="laravel_datatable">
               <thead>
                  <tr>
                   
                    <th style="text-align:center" width="16%" >ID</th>  
                    <th style="text-align:center" width="16%">Name</th>
                    <th style="text-align:center" width="16%">Email</th>
                    <th style="text-align:center" width="16%">Department</th>
                    <th style="text-align:center" width="16%">Action</th>
                  </tr>
               </thead>
            </table>
        </div>

     
        <div class="modal fade" id="ajax-crud-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                    </div>
                        <div class="modal-body">
                            <form id="userForm" name="userForm" class="form-horizontal">
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                    </div>
                                    <label for="email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
                                    </div>
                                    <label for="role" class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-12">
                                        <input type="integer" class="form-control" id="role" name="role" placeholder="Enter Role" value="" maxlength="50" required="">
                                    </div>
                                    <label for="id_dep" class="col-sm-2 control-label">ID Department</label>
                                    <div class="col-sm-12">
                                        <select class="browser-default custom-select" id="id_department" name="id_department">
                                                <option selected>Open this select menu</option>
                                            @foreach ( $deps as $dep )
                                                <option value="{{$dep->id}}">{{$dep->title}}</option>
                                            @endforeach
                                            
                                        </select>
                                       
                                    </div>
                                </div> 
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"></div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready( function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });
            
        $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('users-list') }}",
            columns: [  
                           
                            { data: 'id', name: 'id' },
                            { data: 'name', name: 'name' },
                            { data: 'email', name: 'email' },
                            { data: 'title', name: 'title' },
                            { data: 'action', name: 'action'  }, 
                        ]                
        });
        
    
 
        $('body').on('click', '.edit-user', function () {
            var user_id = $(this).data('id');
            
            $.get('editprofile/' + user_id , function (data) {
                $('#name-error').hide();
                $('#email-error').hide();
                $('#userCrudModal').html("Edit User");
                $('#btn-save').val("edit-user");
                $('#ajax-crud-modal').modal('show');
                $('#user_id').val(data.id);
                $('#id_dep').val(data.id_dep);
                $('#name').val(data.name);
                $('#email').val(data.email);
            })
        });
 
        $('body').on('click', '#delete-user', function () {

            var user_id = $(this).data("id");
            confirm("Are You sure want to delete ?");
            $.ajax({
                type: "delete",
                url: "users/delete/"+user_id,
                success: function (data) {
                var oTable = $('#laravel_datatable').dataTable(); 
                oTable.fnDraw(false);
                },
                error: function (data) {
                    console.log('Error:', data);
            }
            });
        });

    if ($("#userForm").length > 0) {
        $("#userForm").validate({
    
            submitHandler: function(form) {
        
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
              
                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "ajax-crud-list/updateAjax",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
            
                        $('#userForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                        $('#btn-save').html('Save Changes');
                        var oTable = $('#laravel_datatable').dataTable();
                        oTable.fnDraw(false);
                        
                    },
                   error: function (data) {
                        console.log('Error:', data);
                         $('#btn-save').html('Save Changes');
                    }
                });
            }
        })
    } 
        
   
   });

         </script>

@endsection
