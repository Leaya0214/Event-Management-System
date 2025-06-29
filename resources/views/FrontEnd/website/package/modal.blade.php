<style>
    .badge:hover{
        color: white;
    }
     @media screen and (max-width:820px){
        .modal-content{
            width: 100% !important;
        }
    }
    .card-text{
        /*padding-left: 8%;*/
        /*padding-right: 8%;*/
        padding:2% 8%;
    }
</style>

<div class="modal fade" id="view-modal-{{ $package['id'] }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content custom-modal">
        <div class="d-flex justify-content-end">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fs-2" aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card" style="height: auto;">
                <div class="card-body">
                    <h5 class="card-title h1 text-center text-dark fw-bold">
                        {{ $package->category->category_name }}</h5>
                    <h5 class="card-title h3 text-center">{{ $package->name }}</h5>
                    <hr>
                    <p class="text-center">{{ $package->short_details }}</p>
                    <hr>
                    <div class="card-text text-center">{!! $package->long_details !!}</div>
                    <hr>
                  <div class="d-flex justify-content-between">
                    <div class="ml-5 ">
                        <h5 class="h1 fw-bold">{{ $package['discount'] }}TK</h5>
                        <h5 class="h5">Previous Price :{{ $package['amount'] }}Tk
                        </h5>
                    </div>
                     <div style="padding-top:6px">
                        <a href="" class="h4 mr-3 pr-3" onclick="copyToClipboard('copy_{{ $package->id }}')" style="text-decoration: underline; padding-right:12px">Copy Link</a>
                        <input  type="text" id="copy_{{ $package->id }}" value="{{ $currentUrl }}" style="position: absolute; left: -9999px;">
                        <a href="https://wa.me/+8801711082169" class="btn badge bg-dark">Contact
                            With Us</a></div>
    
                    
                  </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
