@extends("layouts.app")

@section("style")
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script
  src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js">
</script>
<style>
input {
  width: 300px;
  padding: 7px;
}

.ui-state-highlight {
  border: 0 !important;
}

.ui-state-highlight a {
  background: #363636 !important;
  color: #fff !important;
}

#ui-datepicker-div {
  top: 100px !important;
}
</style>
@endsection

@section("content")
<section class="container dashboard">
  <div class="dashboard-area">

    @include("partials.managerSidebar")

    <div class="db-content col-lg-9 col-md-7 col-sm-12 col-12">
      <div class="db-top">
        <h3 class="fredoka">
          Quote Requests to {{ Auth::user()->name }}
        </h3>
        <!-- <div>
                        <img class="db-img" src="{{ asset('images/small/dashboard/search.png') }}">
                        <img class="db-img" src="{{ asset('images/small/dashboard/notification.png') }}">
                    </div> -->
      </div>
      <div class="db-field">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
              type="button" role="tab" aria-controls="pills-home" aria-selected="true">Upcoming Quote</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
              type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Previous Quote</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <table class="table table-hover">
              <thead class="table-title">
                <tr class="quote-tr">
                  <th>Sr.No.</th>
                  <th>Name</th>
                  <th>Reg Number</th>
                  <th>Service</th>
                  <th>Date</th>
                  <th class="d-none">GaId</th>
                  <th class="d-none">Price</th>
                  <th class="d-none">Date</th>
                  <th class="d-none">Message</th>
                  <th class="new-exchange-icon"><i class="fa fa-reply"></i></th>
                  <th>Reply</th>
                  <th class="new-exchange-icon"><i class="fa fa-reply-all"></i></th>
                </tr>
              </thead>
              @if($upcomingRepair != 0)
                @if($upcomingRepair == 1 && is_null($up_quotes[0]->id))
                  <tbody>
                    <tr>
                      <td colspan="8">No data available.</td>
                    </tr>
                  </tbody>
                @else
                  @foreach($up_quotes as $key => $updata)
                  <tbody>
                    @if (Auth::user()->id == $updata->garage_id)
                      <tr>
                        <td class="new-id">{{$updata->id}}</td>
                        <td>{{$updata->name}}</td>
                        <td>
                          {{$updata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$updata->year_of_manufacture}}</li>
                            <li>Make: {{$updata->make}}</li>
                            <li>Model: {{$updata->model}}</li>
                            <li>Engine CC: {{$updata->engine_cc}}</li>
                            <li>Version: {{$updata->version}}</li>
                          </ul>
                        </td>
                        @if ($updata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $updata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$updata->created_at}}</td>
                        <td class="d-none">{{$updata->garage_id}}</td>
                        <td class="new-price d-none">{{$updata->price}}</td>
                        <td class="new-pickedDate d-none">{{$updata->picked_date}}</td>
                        <td class="new-reply d-none">{{$updata->reply}}</td>
                        <td class="new-exchange-icon">
                          <i class="fa fa-exchange"></i>
                        </td>
                        @foreach($reply_quotes as $key => $replyData)
                          @if($replyData->quote_id == $updata->quote_id && $replyData->garage_id != Auth::user()->id && $replyData->user_date != '')
                            <td>
                              <button type="button" class="btn btn-success reply-btn">
                                <i class="fa fa-lock"></i>
                              </button>
                            </td>
                            <td>
                              Selected other garage
                            </td>
                          @elseif($replyData->quote_id == $updata->quote_id && $replyData->garage_id == Auth::user()->id)
                            <td>
                              <button type="button" class="btn btn-success reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa fa-eye"></i>
                              </button>
                            </td>
                            <td>
                              @if($updata->user_date != '')
                                {{$updata->user_date}}
                              @endif
                            </td>
                          @elseif($replyData->quote_id == $updata->quote_id && $replyData->garage_id != Auth::user()->id && $replyData->user_date == '')
                            <td>
                              <button type="button" class="btn btn-success reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa fa-eye"></i>
                              </button>
                            </td>
                            <td></td>
                          @endif
                        @endforeach
                        <!-- <td>
                          @foreach($reply_quotes as $key => $replyData)
                            @if($replyData->quote_id == $updata->quote_id && $replyData->user_date)
                              {{$replyData->quote_id}}
                            @endif
                          @endforeach
                        </td> -->
                      </tr>
                    @elseif ($updata->garage_id == '')
                      <tr>
                        <td class="new-id">{{$updata->id}}</td>
                        <td>{{$updata->name}}</td>
                        <td>
                          {{$updata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$updata->year_of_manufacture}}</li>
                            <li>Make: {{$updata->make}}</li>
                            <li>Model: {{$updata->model}}</li>
                            <li>Engine CC: {{$updata->engine_cc}}</li>
                            <li>Version: {{$updata->version}}</li>
                          </ul>
                        </td>
                        @if ($updata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $updata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$updata->created_at}}</td>
                        <td class="d-none"></td>
                        <td class="new-price d-none"></td>
                        <td class="new-pickedDate d-none"></td>
                        <td class="new-reply d-none"></td>
                        <td class="new-exchange-icon"></td>
                        <td>
                          <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal"
                            data-bs-target="#myModal">
                            <i class="fa fa-reply"></i>
                          </button>
                        </td>
                        <td>No reply</td>
                      </tr>
                    @elseif (Auth::user()->id != $updata->garage_id && $updata->garage_id != '')
                      <tr>
                        <td class="new-id">{{$updata->id}}</td>
                        <td>{{$updata->name}}</td>
                        <td>
                          {{$updata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$updata->year_of_manufacture}}</li>
                            <li>Make: {{$updata->make}}</li>
                            <li>Model: {{$updata->model}}</li>
                            <li>Engine CC: {{$updata->engine_cc}}</li>
                            <li>Version: {{$updata->version}}</li>
                          </ul>
                        </td>
                        @if ($updata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $updata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$updata->created_at}}</td>
                        <td class="d-none">{{$updata->garage_id}}</td>
                        <td class="new-price d-none"></td>
                        <td class="new-pickedDate d-none"></td>
                        <td class="new-reply d-none"></td>
                        <td class="new-exchange-icon"></td>
                        @foreach($reply_quotes as $key => $replyData)
                          @if($replyData->quote_id == $updata->quote_id && $replyData->garage_id != Auth::user()->id && $replyData->user_date != '')
                            <td>
                              <button type="button" class="btn btn-success reply-btn">
                                <i class="fa fa-lock"></i>
                              </button>
                            </td>
                            <td>
                              Ended
                            </td>
                          @elseif($replyData->quote_id == $updata->quote_id && $replyData->garage_id == Auth::user()->id)
                            <td>
                              <button type="button" class="btn btn-success reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa fa-eye"></i>
                              </button>
                            </td>
                            <td>
                              @if($updata->user_date != '')
                                {{$updata->user_date}}
                              @endif
                            </td>
                          @elseif($replyData->quote_id == $updata->quote_id && $replyData->garage_id != Auth::user()->id && $replyData->user_date == '')
                            <td>
                              <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                <i class="fa fa-reply"></i>
                              </button>
                            </td>
                            <td>
                              Ongoing
                            </td>
                          @endif
                        @endforeach
                        <!-- <td>
                          <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i class="fa fa-reply"></i>
                          </button>
                        </td>
                        <td>On going</td> -->
                      </tr> 
                    @endif
                  </tbody>
                  @endforeach
                @endif
              @else
                <tbody>
                  <tr>
                    <td colspan="8">No data available.</td>
                  </tr>
                </tbody>
              @endif
            </table>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <table class="table table-hover">
              <thead class="table-title">
                <tr class="quote-tr">
                  <th>Sr.No.</th>
                  <th>Name</th>
                  <th>Reg Number</th>
                  <th>Service</th>
                  <th>Date</th>
                  <th class="d-none">GaId</th>
                  <th class="d-none">Price</th>
                  <th class="d-none">Date</th>
                  <th class="d-none">Message</th>
                  <th class="new-exchange-icon"><i class="fa fa-reply"></i></th>
                  <th>Reply</th>
                  <th class="new-exchange-icon"><i class="fa fa-reply-all"></i></th>
                </tr>
              </thead>
              @if($pastRepair != 0)
                @if($pastRepair == 1 && is_null($pre_quotes[0]->id))
                  <tbody>
                    <tr>
                      <td colspan="8">No data available.</td>
                    </tr>
                  </tbody>
                @else
                  @foreach($pre_quotes as $key => $predata)
                    <tbody>
                      @if (Auth::user()->id == $predata->garage_id)
                      <tr>
                        <td class="new-id">{{$predata->id}}</td>
                        <td>{{$predata->name}}</td>
                        <td>
                          {{$predata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$predata->year_of_manufacture}}</li>
                            <li>Make: {{$predata->make}}</li>
                            <li>Model: {{$predata->model}}</li>
                            <li>Engine CC: {{$predata->engine_cc}}</li>
                            <li>Version: {{$predata->version}}</li>
                          </ul>
                        </td>
                        @if ($predata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $predata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$predata->created_at}}</td>
                        <td class="d-none">{{$predata->garage_id}}</td>
                        <td class="new-price d-none">{{$predata->price}}</td>
                        <td class="new-pickedDate d-none">{{$predata->picked_date}}</td>
                        <td class="new-reply d-none">{{$predata->reply}}</td>
                        <td class="new-exchange-icon">
                          <i class="fa fa-exchange"></i>
                        </td>
                        <td>
                          <button type="button" class="btn btn-success reply-btn" data-bs-toggle="modal"
                            data-bs-target="#myModal_prev">
                            <i class="fa fa-eye"></i>
                          </button>
                        </td>
                        <td>
                          @if($predata->user_date != '')
                            {{$predata->user_date}}
                          @endif
                        </td>
                      </tr>
                      @elseif ($predata->garage_id == '')
                      <tr>
                        <td class="new-id">{{$predata->id}}</td>
                        <td>{{$predata->name}}</td>
                        <td>
                          {{$predata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$predata->year_of_manufacture}}</li>
                            <li>Make: {{$predata->make}}</li>
                            <li>Model: {{$predata->model}}</li>
                            <li>Engine CC: {{$predata->engine_cc}}</li>
                            <li>Version: {{$predata->version}}</li>
                          </ul>
                        </td>
                        @if ($predata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $predata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$predata->created_at}}</td>
                        <td class="d-none"></td>
                        <td class="new-price d-none"></td>
                        <td class="new-pickedDate d-none"></td>
                        <td class="new-reply d-none"></td>
                        <td class="new-exchange-icon"></td>
                        <td>
                          <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal"
                            data-bs-target="#myModal_prev">
                            <i class="fa fa-reply"></i>
                          </button>
                        </td>
                        <td>No reply</td>
                      </tr>
                      @elseif (Auth::user()->id != $predata->garage_id && $predata->garage_id != '')
                      <tr>
                        <td class="new-id">{{$predata->id}}</td>
                        <td>{{$predata->name}}</td>
                        <td>
                          {{$predata->reg_number}}:
                          <ul class="reg-number-show">
                            <li>Year: {{$predata->year_of_manufacture}}</li>
                            <li>Make: {{$predata->make}}</li>
                            <li>Model: {{$predata->model}}</li>
                            <li>Engine CC: {{$predata->engine_cc}}</li>
                            <li>Version: {{$predata->version}}</li>
                          </ul>
                        </td>
                        @if ($predata->detail != "")
                        <td>
                          <ul>
                            @foreach(explode(',', $predata->detail) as $info)
                            <li>{{$info}}</li>
                            @endforeach
                          </ul>
                        </td>
                        @endif
                        <td>{{$predata->created_at}}</td>
                        <td class="d-none">{{$predata->garage_id}}</td>
                        <td class="new-price d-none"></td>
                        <td class="new-pickedDate d-none"></td>
                        <td class="new-reply d-none"></td>
                        <td class="new-exchange-icon"></td>
                        <td>
                          <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal"
                            data-bs-target="#myModal_prev">
                            <i class="fa fa-reply"></i>
                          </button>
                        </td>
                        <td>Selected another garage</td>
                      </tr>
                      @endif
                    </tbody>
                  @endforeach
                @endif
              @else
                <tbody>
                  <tr>
                    <td colspan="8">No data available.</td>
                  </tr>
                </tbody>
              @endif
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Response Message</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form method="post">
              {{ csrf_field() }}
              <div class="mb-3 d-none">
                <label for="quote_id" class="col-form-label">Quote ID:</label>
                <input type="text" class="form-control" id="quote_id" readonly>
              </div>
              <div class="mb-3 d-none">
                <label for="garage_id" class="col-form-label">Garage ID:</label>
                <input type="text" class="form-control" id="garage_id" value="{{ Auth::user()->id }}" readonly>
              </div>
              <div class="mb-3">
                <label for="price" class="col-form-label">Price(€):</label>
                <input type="number" class="form-control" id="price">
              </div>
              <div class="mb-3">
                <label for="datePick" class="col-form-label">Available Date:</label>
                <input type="text" class="form-control" id="datePick">
              </div>
              <div class="mb-3">
                <label for="reply_msg" class="col-form-label">Message:</label>
                <textarea class="form-control" id="reply_msg"></textarea>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit_reply">Send message</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function() {
  $('#datePick').multiDatesPicker();
});
</script>
<script type="text/javascript">
$(function() {
  upcomingCount = {{$upcomingCount}};
  upcomingRepair = {{$upcomingRepair}};
  upcomingBooking = {{$upcomingBooking}};

  $(".upcoming-purchase").html(upcomingCount);
  $(".upcoming-quote").html(upcomingRepair);
  $(".upcoming-booking").html(upcomingBooking);

  reloadUpcomming();
});

$('.reply-btn').click(function() {
  selected_id = $(this).closest('tr').find('.new-id').html();
  selected_price = $(this).closest('tr').find('.new-price').html();
  selected_date = $(this).closest('tr').find('.new-pickedDate').html();
  console.log(selected_date);
  selected_reply = $(this).closest('tr').find('.new-reply').html();
  $('#quote_id').val(selected_id);
  $('#price').val(selected_price);
  $('#datePick').val(selected_date);
  $('#reply_msg').val(selected_reply);
  $('#submit_reply').show();
  if (selected_date != '') {
    $('#submit_reply').hide();
  }
})

$('#submit_reply').on('click', function(e) {
  e.preventDefault();

  var _token = $("input[name='_token']").val();
  var quote_id = $('#quote_id').val();
  var garage_id = $('#garage_id').val();
  var price_val = $('#price').val();
  var picked_date = $('#datePick').val();
  var reply_msg = $('#reply_msg').val();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: 'POST',
    url: "{{ route('manager.managerQuoteReply') }}",
    data: {
      _token: _token,
      quote_id: quote_id,
      garage_id: garage_id,
      price_val: price_val,
      picked_date: picked_date,
      reply_msg: reply_msg
    },
    success: function(data) {
      if (data.status == '2') {
        Command: toastr["success"]("Submitted successfully", "success");
        setTimeout(() => {
          location.reload();
          return false;
        }, 3000);
      }
      else if (data.status == '1') {
        Command: toastr["error"]("Database Error", "Error");
        return false;
      }
      else if (data.status == '0') {
        Command: toastr["warning"]("Validation Error", "Warning");
        return false;
      }
    }
  });
})
</script>
@endsection