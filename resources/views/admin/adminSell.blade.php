@extends('layouts.adminApp')
  
@section('content')
        <div class="row d-flex justify-content-center">
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Car Sell Management</h1>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Eircode</th>
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
                    <form id="productForm" name="productForm" class="form-horizontal d-flex flex-wrap">
                        <div class="alert alert-danger print-error-msg">
                            <ul></ul>
                        </div>
                        <input type="hidden" name="location_id" id="location_id">
                        <div class="form-group col-6">
                            <label for="reg_number" class="control-label">Reg Number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="reg_number" name="reg_number" placeholder="Enter a location" value="" maxlength="50" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="mileage" class="control-label">Mileage</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="mileage" name="mileage" placeholder="Enter a garage" value="" maxlength="50" readonly>
                            </div>
                        </div>
        
                        <div class="form-group col-6">
                            <label for="miles" class="control-label">Km/Miles</label>
                            <div class="col-12">
                                <input type="text" id="miles" name="miles" placeholder="Select Km/Miles" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="timing" class="control-label">Timing Belt</label>
                            <div class="col-12">
                                <input type="text" id="timing" name="timing" placeholder="Enter Timing Belt" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="history" class="control-label">History</label>
                            <div class="col-12">
                                <input type="text" id="history" name="history" placeholder="Enter History" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="finance" class="control-label">Outstanding Finance</label>
                            <div class="col-12">
                                <input type="text" id="finance" name="finance" placeholder="Ourstanding Finance" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="car_issue" class="control-label">Car Issue</label>
                            <div class="col-12">
                                <input type="text" id="car_issue" name="car_issue" placeholder="Enter Car Issue" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="your_note" class="control-label">Note</label>
                            <div class="col-12">
                                <input type="text" id="your_note" name="your_note" placeholder="Enter Note" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <h2>Vehicle Images</h2>
                        </div>
                        <div class="form-group col-12">
                            <label for="passenger_img" class="control-label">Passenger Image</label>
                            <div class="col-12">
                                <img id="passenger_img" name="passenger_img" class="form-control" style="height:100%;" alt="passenger image">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="driver_img" class="control-label">Driver Image</label>
                            <div class="col-12">
                                <img id="driver_img" name="driver_img" class="form-control" style="height:100%;" alt="passenger image">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="front_img" class="control-label">Front Image</label>
                            <div class="col-12">
                                <img id="front_img" name="front_img" class="form-control" style="height:100%;" alt="passenger image">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="rear_img" class="control-label">Rear Image</label>
                            <div class="col-12">
                                <img id="rear_img" name="rear_img" class="form-control" style="height:100%;" alt="passenger image">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="interior_img" class="control-label">Interior Image</label>
                            <div class="col-12">
                                <img id="interior_img" name="interior_img" class="form-control" style="height:100%;" alt="passenger image">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="odometer_img" class="control-label">Odometer Image</label>
                            <div class="col-12">
                                <img id="odometer_img" name="odometer_img" class="form-control" style="height:100%;" alt="passenger image">
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
                ajax: "{{ route('adminSell.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone'},
                    {data: 'eircode', name: 'Eircode'},
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
                var sell_id = $(this).data('id');
                $.get("{{ route('adminSell.index') }}" +'/' + sell_id +'/edit', function (data) {
                    $('#modelHeading').html("Details");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#location_id').val(data.id);
                    $('#reg_number').val(data.reg_number);
                    $('#mileage').val(data.mileage);
                    $('#miles').val(data.miles);
                    $('#timing').val(data.timing);
                    $('#history').val(data.history);
                    $('#finance').val(data.finance);
                    $('#car_issue').val(data.car_issue);
                    $('#your_note').val(data.your_issue);
                    $("#passenger_img").attr("src","{{asset('upload')}}/" + data.passenger_img);
                    $("#driver_img").attr("src","{{asset('upload')}}/" + data.driver_img);
                    $("#front_img").attr("src","{{asset('upload')}}/" + data.front_img);
                    $("#rear_img").attr("src","{{asset('upload')}}/" + data.rear_img);
                    $("#interior_img").attr("src","{{asset('upload')}}/" + data.interior_img);
                    $("#odometer_img").attr("src","{{asset('upload')}}/" + data.odometer_img);
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
                var location_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if(result){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('adminSell.store') }}"+'/'+location_id,
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