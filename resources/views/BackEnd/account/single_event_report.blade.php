@extends('BackEnd.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">


<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                   <h4>Filter by Event</h4> 
                </div>
                <div class="card-body">
                    <!--<form >-->
                         <div class="form-group">
                            <label for="fromDate">From Date</label>
                            <input type="date" class="form-control" id="fromDate" name="fromDate">
                        </div>
                        <div class="form-group mt-3 mb-3">
                            <label for="toDate">To Date</label>
                            <input type="date" class="form-control" id="toDate" name="toDate" oninput="filterEventByDate();">
                        </div> 
                        
                        @if($eventDetails)
                            <div class="form-group">
                                <label for="event" class="form-level">Select Event</label>
                                <select name="event" id="event" class="form-control chosen-select">
                                    <option value=""selected disabled>Choose any event</option>
                                    @foreach($eventDetails as $event)
                                        <option value="{{$event->id}}">{{$event->venue}}--{{date('d/m/Y', strtotime($event->date))}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary mt-3" onclick="viewEventHistory();">Filter</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header text-center">
                    {{-- <h3> Single Event Report</h3>
                    <h4 class="mt-3">Bridal Harmony</h4>
                    <h5 class="mt-3">For {{$monthname}} - {{$currentYear}}</h5> --}}
                </div>
                <div class="card-body">
                  
                    <div class="row">
                        <div class="col-md-12">
                            <div id="wrapper">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.chosen-select').chosen();
  
        });
</script>

<script>
    function viewEventHistory(){
        // $('#main_table').hide();
        $('.btn-warning').hide();
        var event_id = document.getElementById('event').value;
        var start_date = document.getElementById('fromDate').value;
        var end_date = document.getElementById('toDate').value;
        var url = "{{route('single.report.history')}}"
        $.ajax({
            type:'GET',
            url:url,
            data:{event_id,start_date,end_date},
            success:function(data){
                $('#wrapper').html(data);
            }
        });
    }
    
    function filterEventByDate(){
        $('.btn-warning').hide();
        
        var start_date = document.getElementById('fromDate').value;
        var end_date = document.getElementById('toDate').value;
        var url = "{{route('filter-single-event')}}";
        
        $.ajax({
            type:'GET',
            url:url,
            data:{start_date,end_date},
            success:function(data){
                console.log(data);
                 $('#event').html('');
                    $('#event').html('<option value="" selected disabled>Choose any event</option>'); // Add the default option
                    $.each(data, function(key, value) {
                        $('#event').append('<option value="' + value.id + '">' + value.venue +
                            '</option>');

                });
                $('#event').trigger("chosen:updated");
                $('.chosen-select').chosen();

            }
        });
    }
</script>
@endsection