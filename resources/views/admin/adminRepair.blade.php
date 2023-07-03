@extends('layouts.adminApp')
  
@section('content')
        <div class="row d-flex justify-content-center">
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Users' Quote Management</h1>
                    <a class="btn btn-success mt-3 d-none" href="javascript:void(0)" id="createNewProduct"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Reg Number</th>
                                <th>Location</th>
                                <th>Name<th>
                                <!-- <th>Email</th> -->
                                <th>Phone Number</th>
                                <th>Quote Time</th>
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

                        <div class="form-group d-none">
                            <label for="repair_id" class="col-12 control-label">Repair ID</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="repair_id" name="repair_id" placeholder="Enter Repair ID" maxlength="50" required>
                            </div>
                        </div>

                        <div class="alert alert-primary print-data-msg">
                            <label class="col-12 control-label">- Requested Services Items</label>
                            <ul></ul>
                        </div>

                        <div class="alert alert-info response-data-msg">
                            <label class="col-12 control-label">- Garages Response</label>
                            <ul></ul>
                        </div>

                        <div class="alert alert-success user-data-msg">
                            <label class="col-12 control-label">- User Response</label>
                            <ul></ul>
                        </div>

                        <!-- <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Send Reply</button>
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
                ajax: "{{ route('adminRepair.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'reg_number', name: 'reg_number'},
                    {data: 'sel_location', name: 'sel_location'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
            $('#createNewProduct').click(function () {
                $('#saveBtn').val("create-product");
                $('#repair_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });
            
            $('body').on('click', '.editProduct', function () {
                $(".print-data-msg").find("li").remove();
                $(".response-data-msg").find("li").remove();
                $(".user-data-msg").find("li").remove();
                var repair_id = $(this).data('id');
                $.get("{{ route('adminRepair.index') }}" +'/' + repair_id +'/edit', function (data) {
                    $('#modelHeading').html("Service Details");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    console.log(data);
                    data.service_items.map((value, index) => {
                        $(".print-data-msg").find("ul").append('<li>'+value.detail+'</li>');
                    }) 

                    data.response.map((value, index) => {
                        $(".response-data-msg").find("ul").append('<li>Garage: '+value.name+'<br/>Location: '+value.location+'<br/>Price: '+value.price+'<br/>Available Date: '+value.picked_date+'<br/>Message: '+value.reply+'<br/></li>');
                    })   
                    
                    data.response.map((value, index) => {
                        if(value.user_date != null) {
                            $(".user-data-msg").find("ul").append('<li>Garage: '+value.name+'<br/>Selected Date: '+value.user_date+'<br/>Deposit Paid(€): '+value.deposit+'</li>');
                        }
                        
                    })
                                   
                    $('#repair_id').val(repair_id);
                })
            });
            
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Send Reply');

                let price = $('#price').val();
                let reply = $('#reply').val();
                if(price == '' && reply == '') {
                    Command: toastr["warning"]("Please input a price and reponse", "Warning");
                    return;
                }
            
                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('adminRepair.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteProduct', function (){
                var repair_id = $(this).data("id");
                var result = confirm("Are You sure want to delete !");
                if(result){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('adminRepair.store') }}"+'/'+repair_id,
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