@extends('layouts.adminApp')
  
@section('content')
        <div class="row d-flex justify-content-center">
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Pre Purchase Inspection Management</h1>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reg-Num</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Garage</th>
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
                            <label for="seller_phone" class="control-label">Seller Phone</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="seller_phone" name="seller_phone" placeholder="Enter a seller phone" value="" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="control-label">Date</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Enter a date" value="" maxlength="50" required>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="location" class="control-label">Location</label>
                            <div class="col-12">
                                <input type="text" id="location" name="location" placeholder="Enter location" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="prefer_time" class="col-sm-5 control-label">Prefer Time</label>
                            <div class="col-12">
                                <input type="text" id="prefer_time" name="prefer_time" placeholder="Enter Prefer Time" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inspection" class="col-sm-5 control-label">Inspection</label>
                            <div class="col-12">
                                <input type="text" id="inspection" name="inspection" placeholder="Enter Inspection" class="form-control" required>
                            </div>
                        </div>
        
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
                ajax: "{{ route('adminPurchase.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'reg_number', name: 'Reg Number'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone'},
                    {data: 'garage', name: 'garage'},
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
                var purchase_id = $(this).data('id');
                $.get("{{ route('adminPurchase.index') }}" +'/' + purchase_id +'/edit', function (data) {
                    $('#modelHeading').html("Inspection Details");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#location_id').val(data.id);
                    $('#seller_phone').val(data.seller_phone);
                    $('#date').val(data.date);
                    $('#location').val(data.location);
                    if(data.prefer_time == 'am') {
                        $('#prefer_time').val('Morning 9:30am - 11:30am');
                    } else if(data.prefer_time == 'pm') {
                        $('#prefer_time').val('Afternoon 12:30pm - 2:30pm');
                    } else if(data.prefer_time == 'eve') {
                        $('#prefer_time').val('Evening 18:30pm - 20:30pm');
                    }
                    
                    $('#inspection').val(data.inspection);
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
                var purchase_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if(result){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('adminPurchase.store') }}"+'/'+purchase_id,
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