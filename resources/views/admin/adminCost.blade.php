@extends('layouts.adminApp')
  
@section('content')
        <div class="row d-flex justify-content-center">
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Transport Cost Management</h1>
                </div>
            </div>
        </div>
    
        <form id="productForm" name="productForm" class="form-horizontal d-flex flex-wrap">
            <input type="hidden" name="cost_id" id="cost_id" value="1">
            <div class="form-group col-8">
                <label for="cost" class="col-12 control-label">Cost Per km(€)</label>
                <div class="col-12">
                    <input type="number" class="form-control" id="cost" name="cost" placeholder="Enter the transport cost per km" maxlength="10" required="">
                </div>
            </div>

            <div class="form-group col-8">
                <label for="deposit_cost" class="col-12 control-label">Minimum Transport Cost (€)</label>
                <div class="col-12">
                    <input type="number" class="form-control" id="deposit_cost" name="deposit_cost" placeholder="Enter the minimum transport cost" maxlength="10" required="">
                </div>
            </div>

            <div class="col-8" style="margin-top: 31px; text-align: center;">
                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save Updates</button>
            </div>
        </form>

    <script type="text/javascript">
        $(function () {
        
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $costper = {{$costper}};
            $mincost = {{$mincost}};
            $('#cost').val($costper);
            $('#deposit_cost').val($mincost);
            
            $('#saveBtn').click(function (e) {
                e.preventDefault();
                var cost_id = $('#cost_id').val();
                var cost = $('#cost').val();
                var deposit_cost = $('#deposit_cost').val();

                $.ajax({
                    data: {
                        cost_id:cost_id,
                        cost:cost, 
                        deposit_cost: deposit_cost,
                    },
                    url: "{{ route('adminCost.store') }}",
                    type: "POST",
                    success: function (data) {
                        $data_text = data.statusText;
                        Command: toastr["success"]($data_text, "Success");
                    },
                    error: function (data) {
                        Command: toastr["error"]("Please input the transport cost");
                        console.log('Error:', data);
                    }
                });
                
            });

        });
    </script>
@endsection