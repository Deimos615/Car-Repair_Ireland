@extends('layouts.adminApp')
  
@section('content')
        <div class="row d-flex justify-content-center">
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Transport Management</h1>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>RegNumber</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <div class="alert alert-danger print-error-msg">
                            <ul></ul>
                        </div>
                        <input type="hidden" name="location_id" id="location_id">
                        <div class="form-group">
                            <label for="pickup_location" class="col-12 control-label">Pickup Location</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="pickup_location" name="pickup_location" placeholder="Enter a Pickup Location" value="" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="destination_location" class="col-12 control-label">Destination Location</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="destination_location" name="destination_location" placeholder="Enter a Destination Location" value="" maxlength="50" required>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="distance" class="col-12 control-label">Distance</label>
                            <div class="col-12">
                                <input type="text" id="distance" name="distance" placeholder="Enter distance" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-12 control-label">Duration</label>
                            <div class="col-12">
                                <input type="text" id="duration" name="duration" placeholder="Enter duration" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="esti_value" class="col-12 control-label">Estimation Value</label>
                            <div class="col-12">
                                <input type="text" id="esti_value" name="esti_value" placeholder="Enter Estimation Value" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost_value" class="col-12 control-label">Cost per km</label>
                            <div class="col-12">
                                <input type="text" id="cost_value" name="cost_value" placeholder="Enter Cost per km" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="purpose" class="col-12 control-label">Loading Purpose</label>
                            <div class="col-12">
                                <input type="textarea" id="purpose" name="purpose" placeholder="Enter Loading Purpose" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-12 control-label">Note</label>
                            <div class="col-12">
                                <input type="text" id="note" name="note" placeholder="Enter note" class="form-control" required>
                            </div>
                        </div>
        
                        <!-- <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
        
        
    <script type="text/javascript">
        $(function () {
        
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('adminTransport.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'reg_number', name: 'reg_number'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone'},
                    {data: 'date', name: 'date'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
            $('#createNewProduct').click(function () {
                $('#saveBtn').val("create-product");
                $('#location_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Garage");
                $('#ajaxModel').modal('show');
            });
            
            $('body').on('click', '.editProduct', function () {
                var transport_id = $(this).data('id');
                $.get("{{ route('adminTransport.index') }}" +'/' + transport_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Garage");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#pickup_location').val(data.pickup_location);
                    $('#destination_location').val(data.destination_location);
                    $('#distance').val(data.distance);
                    $('#duration').val(data.duration);
                    $('#pickup_loation').val(data.pickup_location);
                    $('#destination_location').val(data.destination_location);
                    $('#esti_value').val(data.estimation_value);
                    $('#cost_value').val(data.cost_value);
                    $('#purpose').val(data.loading_purpose);
                    $('#note').val(data.note);
                })
            });
            
            $('#saveBtn').click(function (e) {
                e.preventDefault();
            
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('adminLocation.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if(data.status == '0') {
                            printErrorMsg(data.error);
                            return false;
                        }
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $data_text = data.statusText;
                        Command: toastr["success"]($data_text, "Success");
                        table.draw();
                    },
                    error: function (data) {
                        Command: toastr["error"]("Please input all the fields exactly!");
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
                function printErrorMsg (msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( msg, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        $( ".print-error-msg" ).focus();
                    });
                }
            });

            $('body').on('click', '.deleteProduct', function (){
                var transport_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if(result){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('adminTransport.store') }}"+'/'+transport_id,
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }else{
                    return false;
                }
            });
        });
    </script>
@endsection