
@extends('BackEnd/master')
<style>
    body{
    color: #6F8BA4;
    /* margin-top:20px; */
}
.section {
    position: relative;
}
.gray-bg {
    background-color: #f5f5f5;
}
img {
    max-width: 100%;
}
img {
    vertical-align: middle;
    border-style: none;
}
/* About Me 
---------------------*/
.about-text h3 {
  font-size: 45px;
  font-weight: 700;
  margin: 0 0 6px;
}
@media (max-width: 767px) {
  .about-text h3 {
    font-size: 35px;
  }
}
.about-text h6 {
  font-weight: 600;
  margin-bottom: 15px;
}
@media (max-width: 767px) {
  .about-text h6 {
    font-size: 18px;
  }
}
.about-text p {
  font-size: 18px;
  max-width: 450px;
}
.about-text p mark {
  font-weight: 600;
  color: #20247b;
}

.about-list {
  padding-top: 10px;
}
.about-list .media {
  padding: 5px 0;
}
.about-list label {
  color: #20247b;
  font-weight: 600;
  width: 88px;
  margin: 0;
  position: relative;
}
/* .about-list label:after {
  content: "";
  position: absolute;
  top: 0;
  bottom: 0;
  right: 11px;
  width: 1px;
  height: 12px;
  background: #20247b;
  -moz-transform: rotate(15deg);
  -o-transform: rotate(15deg);
  -ms-transform: rotate(15deg);
  -webkit-transform: rotate(15deg);
  transform: rotate(15deg);
  margin: auto;
  opacity: 0.5;
} */
.about-list p {
  margin: 0;
  font-size: 15px;
}

@media (max-width: 991px) {
  .about-avatar {
    margin-top: 30px;
  }
}

.about-section .counter {
  padding: 22px 20px;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
}
.about-section .counter .count-data {
  margin-top: 10px;
  margin-bottom: 10px;
}
.about-section .counter .count {
  font-weight: 700;
  color: #20247b;
  margin: 0 0 5px;
}
.about-section .counter p {
  font-weight: 600;
  margin: 0;
}
mark {
    background-image: linear-gradient(rgba(252, 83, 86, 0.6), rgba(252, 83, 86, 0.6));
    background-size: 100% 3px;
    background-repeat: no-repeat;
    background-position: 0 bottom;
    background-color: transparent;
    padding: 0;
    color: currentColor;
}
.theme-color {
    color: #fc5356;
}
.dark-color {
    color: #20247b;
}

</style>
@section('content')

<section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">About Me</h3>
                    {{-- <h6 class="theme-color lead">{{$user->designation}}</h6> --}}
                    {{-- <p>I <mark>design and develop</mark> services for customers of all sizes, specializing in creating stylish, modern websites, web services and online stores. My passion is to design digital user experiences through the bold interface and meaningful interactions.</p> --}}
                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Name</label>
                                <p>{{$user->name}}</p>
                            </div>
                            <div class="media">
                                <label>Designation</label>
                                <p>{{$user->designation}}</p>
                            </div>
                            <div class="media">
                                <label>Phone</label>
                                <p>{{$user->phone}}</p>
                            </div>
                            <div class="media">
                                <label>Experience Level</label>
                                <p>{{$user->experience_level}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>E-mail</label>
                                <p>{{$user->email}}</p>
                            </div>
                            <div class="media">
                                <label>Job Type</label>
                                <p>{{$user->category}}</p>
                            </div>
                            <div class="media">
                              <label>Phone</label>
                              <p>{{$user->alternate_number}}</p>
                            </div>
                            <div class="media">
                                <label>Address</label>
                                <p>{{$user->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="{{asset('frontend/images/avatar.png')}}" title="" alt="">
                </div>
            </div>
        </div>
        <div class="counter">
            <div class="row">
                {{-- <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="{{$total_event}}" data-speed="{{$total_event}}">{{$total_event}}</h6>
                        <p class="m-0px font-w-600">Total Event</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="150" data-speed="150">{{$payment->total_amount}}</h6>
                        <p class="m-0px font-w-600">Total Payment</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="{{$payment->paid}}" data-speed="{{$payment->paid}}">{{$payment->paid}}</h6>
                        <p class="m-0px font-w-600">Total Paid</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="{{$payment->due}}" data-speed="{{$payment->due}}">{{$payment->due}}</h6>
                        <p class="m-0px font-w-600">Total Due</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection