<table class="table table-bordered main-table" data-table="true" id="eventTable">
    <thead>
        <tr>
            <th>SL NO.</th>
            <th>Booking No</th>
            {{-- <th>Booking Info</th> --}}
            <th>Event Type</th>
            <th>Event Date</th>
            <th>Event Shift</th>
            <th>Event Time</th>
            <th>Package</th>
            <th>Package Name</th>
            <th>Status</th>
            <th>Amount Info</th>
        </tr>
    </thead>
    <tbody>
        @php $sl = 0 @endphp
        @foreach($result as $v_result)
            <tr>
                <td>{{++$sl}}</td>
                <td>{{$v_result->booking_id}}</td>
                <td>{{$v_result->type->type_name}}</td>
                <td>{{$v_result->date}}</td>
                <td>{{$v_result->shift->shift_name}}</td>
                @php $time = date('g:i a',strtotime($v_result->start_time)).' - '.date('g:i a',strtotime($v_result->end_time)) @endphp
                <td>{{$time}}</td>
                <td>{{$v_result->category->category_name}}</td>
                <td>{{$v_result->package->name}}</td>
                <td>
                    @if($v_result->status == "0")
                        Pending
                    @elseif($v_result->status == "1")
                        Active
                    @elseif($v_result->status == "2")
                        Deactive
                    @endif
                </td>
                <td>
                    <strong>Total Amount</strong> {{$v_result->payment_amount}}<br>
                    <strong>Advance</strong> {{$v_result->advance}}<br>
                    <strong>Due</strong>{{$v_result->due_amount}}<br>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>