@extends ('layouts.app')
@section ('content')

    <div class="container">
        <div id="jstree">
        </div>
    </div>

    <div class="row">
    <div class="container">
        <input type="hidden" id="dep_id" name="dep_id" value="">
        <table class="table table-bordered hover order-column" id="datatable">
            <thead>
                <tr>
                <th style="text-align:center" width="16%">Name</th>
                <th style="text-align:center" width="16%">Email</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
@endsection

@section ('script')
 
<script> 
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "get",
        url: "/getTree",
        success: function (data) {
            console.log("Data : ",data);
            $('#jstree').jstree({ 'core' : {'data' : data}});
        },
            error: function (data) {
            console.log('Error:', data);
            }
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
			url: "/getAllUser",
			type: 'GET',
			data: function (d) {
				d.id = $('#dep_id').val();
			}
		},
            columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                   ]                
    });

});
 
    $('body').on('click', '.jstree-node', function (e) {
        e.stopPropagation(); 
        var id_dep = $(this).attr("id");                
        $('#dep_id').val(id_dep);
        $('#datatable').DataTable().draw(true);

    });

</script>


@endsection 