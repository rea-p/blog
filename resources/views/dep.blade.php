@extends ('layouts.app')


@section ('content')


    <h1 style="text-align:center">This is the Department Page.</h1>
    
       <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-dep">Add New Department</a>
       
<br><br>
         
         

        <div>
        <div class="container">
            <table class="table table-bordered hover order-column" id="department_datatable">
            
    
               <thead>
                  <tr>
                    
                    <th style="text-align:center" >ID</th>  
                    <th style="text-align:center" >ID Department</th>
                    <th style="text-align:center" >Title</th>
                    <th style="text-align:center" >Description</th>
                    <th style="text-align:center">Action</th>
                  </tr>
               </thead>
            </table>
        </div>


        <div class="modal fade" id="department-crud" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="departmentModal"></h4>
                    </div>
                        <div class="modal-body">
                            <form id="departmentForm" name="departmentForm" class="form-horizontal">
                                <input type="hidden" name="department_id" id="department_id">
                                <div class="form-group">
                                    <label for="id_department" class="col-sm-2 control-label">ID Department</label>
                                    
                                    <div class="col-sm-12">
                                        <select class="browser-default custom-select" id="id_department" name="id_department">
                                                <option value= '0' selected>Main Departments </option>
                                            @foreach ( $deps as $dep )
                                                <option value="{{$dep->id}}">{{$dep->title}}</option>
                                            @endforeach
                                            
                                        </select>

                                    </div>
                                    <label for="title" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50" required="">
                                    </div>
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="" maxlength="50" required="">
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
            
        $('#department_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('dep-list') }}",
            columns: [
                            { data: 'id', name: 'id' },
                            { data: 'id_dep', name: 'id_dep' },
                            { data: 'title', name: 'title' },
                            { data: 'description', name: 'description' },
                            { data: 'action', name: 'action', orderable: false }, 
                        ]                
        });
       
     
        $('#create-new-dep').click(function () {
            $('#btn-save').val("create-dep");
            $('#department_id').val('');
            $('#departmentForm').trigger("reset");
            $('#departmentModal').html("Add New Department");
            $('#department-crud').modal('show');
        });
 
        $('body').on('click', '.edit-dep', function () {
            var dep_id = $(this).data('id');
            
            $.get('editdep/' + dep_id , function (data) {
                $('#name-error').hide();
                $('#email-error').hide();
                $('#departmentModal').html("Edit Department");
                $('#btn-save').val("edit-dep");
                $('#department-crud').modal('show');
                $('#department_id').val(data.id);
                $('#id_dep').val(data.id_dep);
                $('#title').val(data.title);
                $('#description').val(data.description);
            })
        });
 
        $('body').on('click', '#delete-dep', function () {

            var dep_id = $(this).data("id");
            confirm("Are You sure want to delete ?");
            $.ajax({
                type: "delete",
                url: "dep/delete/"+dep_id,
                success: function (data) {
                    alert(data.message);
                    var oTable = $('#department_datatable').dataTable(); 
                    oTable.fnDraw(false);

                },
                error: function (data) {
                    console.log('Error:', data);
            }
            });
        });

    if ($("#departmentForm").length > 0) {
        $("#departmentForm").validate({
    
            submitHandler: function(form) {
        
                var actionType = $('#btn-save').val();
                $('#btn-save').html('Sending..');
              
                $.ajax({
                    data: $('#departmentForm').serialize(),
                    url: "/dep/update/depart",
                    type: "post",
                    dataType: 'json',
                    success: function (data) {
            
                        $('#departmentForm').trigger("reset");
                        $('#department-crud').modal('hide');
                        $('#btn-save').html('Save Changes');
                        var oTable = $('#department_datatable').dataTable();
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

