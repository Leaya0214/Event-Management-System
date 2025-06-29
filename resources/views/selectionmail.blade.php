<!DOCTYPE html>
<html>
<head>
    <title>Bridal Harmony - Client Selection</title>
</head>
<body>
   <p>Client Name :  {{ $data['client_name'] }}</p>
   <p>Booking Id  :  {{ $data['booking_id'] }}</p>
   <p>Event Date  : {{ $data['event_date'] }}</p>
   <p>Event Type  :  {{ $data['event_type'] }}</p>
   <p>venue       :  {{ $data['venue'] }}</p>
   <p>Package     :  {{ $data['package'] }}</p>
   <p>Client submit selection photos for edit  :  {{ $data['photo_selection'] }}</p>
   @if($data['video_selection']!= null)
   <p>Client Submit song selection             :  {{ $data['video_selection'] }}</p> 
    @endif
</body>
</html>





