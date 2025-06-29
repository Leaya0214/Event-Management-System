    @foreach ($events as $event)
        @php
            $details  = $event->details;
            $eventDetails = $event->details;
            $payment = $event->payment;
        @endphp
        {{-- Status Udate Modal  --}}
        @foreach($details as $s_detail)
                @include('BackEnd.webcontent.event.statusview', ['s_detail' => $s_detail])
         @php
            $artists = App\Models\BackEnd\EventDetailsLog::whereIn('event_details_id', $details->pluck('id'))->get();
            $customerReviews = App\Models\CustomerExperience::whereIn('detail_id', $details->pluck('id'))->get();
            $officeReviews = App\Models\OfficeExperience::whereIn('detail_id', $details->pluck('id'))->get();
            $artistReviews = App\Models\BackEnd\PhotographerExperience::whereIn('event_detail_id', $details->pluck('id'))->get();
        @endphp
            @include('BackEnd.webcontent.event.office_experience', ['s_detail' => $s_detail])
            @include('BackEnd.webcontent.event.view_experience', ['s_detail' => $s_detail, 'customerReviews' => $customerReviews, 'officeReviews' => $officeReviews, 'artistReviews' => $artistReviews])

        @endforeach

            @include('BackEnd.webcontent.event.event_details', ['event' => $event])
        @endforeach
