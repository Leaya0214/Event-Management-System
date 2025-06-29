<!doctype html>
<html lang="en">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Bridal Harmony Login</title>
 <link rel="stylesheet" href="{{asset('backend')}}/css/bootstrap.min.css">
 <style>
   body{
      background: #ece4c1;
   }
</style>
<body>
 <div class="container-fluid py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
   <div class="col-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card text-white" style="background:#2e413e">
     <div class="card-body p-5 text-center">
        <img src="{{ asset('backend/system_setting/b_logo.png') }}" alt="" height="100" width="100">
      <h2 class="fw-bold mb-2 mt-1 text-uppercase">Login</h2>
      <p class="text-white-40 mb-4">Please enter your email and password! </p>
      <form class="form" action="{{route('submit-login')}}" method="POST">
         @csrf
       <div class="form-outline mb-4">
        <input type="email" name="email" placeholder="Email Address" class="form-control form-control-md"> </div>
       <div class="form-outline mb-4">
        <input type="password" name="password" placeholder="Password" class="form-control form-control-md"> </div>
       <div class="form-outline mb-4 d-grid gap-2">
        <button type="submit" class="btn" style="background: #d4b536">Login </button>
       </div>
       <div>
        <p class="mb-2"> Don't have an account? <a class="text-white-50 fw-bold" href="{{ route('book_us') }}">Book Now</a></p>
       </div>
       <hr class="my-4"> 
    </form>
     </div>
    </div>
   </div>
  </div>
 </div>
 <script src="{{asset('backend')}}/js/bootstrap.min.js"></script>
</body>

</html>