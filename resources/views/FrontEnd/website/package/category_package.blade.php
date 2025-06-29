@extends('welcome')
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"-->
<!--    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/css/bootstrap.css" />


<style>
.container{
    width:83% !important;
}
    figure {
        margin: 0;
        padding: 0;
        position: relative;
    }

    figcaption {
        position: absolute;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        width: 100%;
        padding: 10px;
        text-align: center;
    }

    .package-card {
        height: 350px !important;
    }
  
    @media screen and (min-width: 960px) {
        .navbar {
            justify-content: center;
            display: block !important;
        }
    }

    .color-patch {
        background: hsla(4, 39%, 49%, 0.541);
        clear: both;
    }

    .master-header {
        background-color: #D3A29E !important;
    }

    .mb-4 {
        margin-left: 0 !important;
    }

    .card-body {
        font-size: 16px !important;
    }

    .package {
        margin: 160px 0;
    }

    .list-group-item {
        font-size: 15px !important;
    }

    .btn-primary {
        font-size: 15px !important;
    }

  @media screen and (max-width: 1024px) {
        .mb-4 {
            margin-left: 0 !important;
        }

        .list-group-item{
            padding: 0.6rem 0.7rem;
        }

        .ml-4{
            margin-left: 0 !important;
        }
        .px-4{
            padding: 4px !important;
        }
        .type-button{
            font-size:16px;
        }
        .container{
            width:94% !important;
        }
        
    }
    @media screen and (max-width: 639px) {

        .package-card {
            height: 350px !important;
        }

        .package {
            margin: 80px 0 !important;
        }

        button {
            font-size: 14px !important;
        }

    }

    @media screen and (max-width: 639px) {

        .mb-4 {
            margin-left: 0 !important;
        }


        .card-body {
            font-size: 13px !important;
        }

        ul {
            margin-bottom: 20px !important;
        }

        li {
            font-size: 14px !important;
        }
        
        .first-li{
            display: flex;
            justify-content: center;
        }
    }

    .modal-content {
        width: 60%;
        height: 70%;
        margin: auto;
        border-radius: 15px;
        overflow: hidden;
    }

    hr {
        border: 1px solid #000000;
        border-radius: 2px;
    }
</style>

 <style>
       
        .type-button,.category-button {
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: #505050; /* Set the color of the button text */
            font-size: 18px; /* Adjust the font size as needed */
            text-decoration: none;
            margin-right: 10px;
            border-radius:0px;
        }
        
    
        .type-button.selected,.category-button.selected {
            padding-bottom: 3px; 
            text-decoration: underline;
            text-decoration-color:#d1ad36;
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: black; /* Set the color of the button text */
            font-size: 18px;
        }
        .category-button.selected {
            padding-bottom: 3px; 
            text-decoration: none;
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: black; /* Set the color of the button text */
            font-size: 18px;
        }
        
        .type-button.active {
            padding-bottom: 3px; 
            text-decoration: underline;
            text-decoration-color:#d1ad36;
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: black; /* Set the color of the button text */
            font-size: 18px;
        }
        .category-button.active {
            padding-bottom: 3px; 
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: black; /* Set the color of the button text */
            font-size: 18px;
        }
    
        .type-button.active:hover{
            background: none;
            color: black;
            padding-bottom: 3px; 
            text-decoration: underline;
            text-decoration-color:#d1ad36;
            background: none; 
            border: none;
        }
        .category-button.active:hover {
            background: none;
            color: black;
            padding-bottom: 3px; 
            background: none; 
            border: none;
        }
        .type-button:hover {
            background: underline;
            color: black;
             padding-bottom: 3px; 
            text-decoration: underline;
            text-decoration-color:#d1ad36;
            background: none;
            border: none; 
        }.category-button:hover {
            color: black;
            padding-bottom: 3px; 
            background: none;
            border: none; 
        }
        .btn-secondary.active:focus, .btn-secondary:active:focus{
            box-shadow: none !important;
        }
        .btn-success.active:focus, .btn-success:active:focus{
            box-shadow: none !important;
        }
        .list-group{
            border: none;
            border-radius: 0;
            box-sizing: unset;
        }
        .category{
            border-right: 1px solid #d1ad36;
            padding-right: 3px;
        }
    
        .list-group-item{
            border: none;
        }

        @media screen and (max-width:768px){
            .mt-5{
                margin-top: 10px !important;
            }
            .category{
            border:none;
            padding: 0;
            }

            .text-end{
                text-align: center !important;
             }

        }
        
    </style>
@section('content')
    <div class="package">
        {{-- <h1 class="text-4xl font-semibold text-center mb-6 h1">Packages For <b>{{ $branch->branch_name }} City</b></h1> --}}
        <div class="container  px-4 py-8 mt-5">
            <div class="row">
                {{-- <div class="col-lg-2 col-md-3 col-sm-6 pr-md-2 pr-sm-2 mt-5 category">
                    <ul class="list-group text-lg h3 font-medium mt-3 text-end">
                        <li class="list-group-item mb-2 first-li" style="font-size:15px"><button onclick="location.reload()"
                                class="category-button selected">ALL Packages</button>
                            </li>
                        @foreach ($package_category as $category)
                            <li class="list-group-item mb-2  first-li" style="font-size:15px"><button data-group="category"
                                    class="category-button" data-id="{{ $category->id }}" data-category="{{ $category->id }}">
                                    <input type="hidden" id="type_id" value="{{ $category->id }}">
                                    {{ $category->category_name }}</button>
                                </li>
                        @endforeach
                    </ul>
                </div> --}}
                <div class="col-md-9">
                    {{-- <div class="mb-4 text-center ml-2">
                        <a href="#" class="btn btn-lg btn-secondary h-10 px-4 py-2 selected type-button active" data-group="type"
                            data-type="all" value="500">
                            ALL Type
                        </a>
                        @foreach ($package_type as $type)
                            <a href="#" data-group="type" class="btn btn-lg h-10 px-4 py-2 btn-secondary type-button"
                                data-type="{{ $type->id }}">
                                {{ $type->package_type_name }}
                            </a>
                        @endforeach
                    </div> --}}
                    <div class="row row-cols-1 row-cols-md-3 row-cols-sm-3 g-4 mb-3">
                        @foreach ($packages as $package)
                        @if($package->category)
                            <div class="col package-card" data-category="{{ $package->category->id }}"
                                data-type="{{ $package->type->id }}">
                                <div class="card" data-category="{{ $package->category->id }}"
                                    data-type="{{ $package->type->id }}">
                                    <figure class="position-relative">
                                        <img src="{{ asset('backend/package/' . $package->pkg_image) }}"
                                            class="card-img-top" alt="{{ $package->category->category_name }}"
                                            style="height: 180px">
                                        <figcaption>
                                            <h5 class="h2 text-center">{{ $package->category->category_name }}</h5>
                                            <h3 class="card-text">{!! $package->name !!}</h3>
                                        </figcaption>
                                    </figure>
                                    <div class="card-body">
                                        <h5 class="text-center">{{ $package->short_title }}</h5>
                                        <hr>
                                        <div class="d-flex justify-content-between mt-5 ">
                                            <h4 class="text-dark">TK. @if ($package->discount)
                                                    {{ $package->discount }}
                                                @else
                                                    {{ $package->discount }}
                                                @endif
                                            </h4>
                                            <button type="button" onclick="loadModalContent({{ $package['id'] }})"
                                                class="btn btn-secondary bg-dark">Details</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <div id="modal-container"></div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $(".type-button").click(function () {
            $(".type-button").removeClass("selected");
            $(".type-button").removeClass("active");
            $(this).addClass("active");
        });

        $(".category-button").click(function () {
            $(".category-button").removeClass("selected");
            $(".category-button").removeClass("active");
            $(this).addClass("active");

            // var categoryId = $(this).data("id");
            // var tempInput = $("<input>");
            // $("body").append(tempInput);
            // tempInput.val(link).select();
            // document.execCommand("copy");
            // tempInput.remove();
            // alert("Link copied to clipboard: " + link);

        });
    });
</script>
    <script>
        function loadModalContent(itemId) {
            $.ajax({
                url: '/getModalContent/' + itemId,
                method: 'GET',
                success: function(data) {
                    $('#modal-container').html(data);
                    const modal = new bootstrap.Modal(document.getElementById("view-modal-" + itemId));
                    modal.show();
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching modal content:", error);
                }
            });
        }
    </script>


    <script>
        function copyToClipboard(id) {
            var inputElement = document.getElementById(id);
            console.log(inputElement);
            inputElement.select();
            document.execCommand('copy');
            alert('Copied to clipboard!');
        }
    </script>

    <script>
        function toggleActive(button) {
            var group = button.data('group');
            var isBtnSuccess = button.hasClass('btn-success');

            $('.category-button[data-group="' + group + '"]').removeClass('btn-success');
            $('.type-button[data-group="' + group + '"]').removeClass('btn-success');
            button.toggleClass('btn-success', !isBtnSuccess);
        }

        function filterPackages() {
            var activeCategories = $('.category-button.btn-success').map(function() {
                return $(this).data('category');
            }).get();

            var activeTypes = $('.type-button.btn-success').map(function() {
                return $(this).data('type');
            }).get();

            if (activeCategories.length > 0 && activeTypes.length > 0) {
                if (activeCategories.length > 0 && activeTypes[0] === "all") {
                    $('.package-card').hide();
                    activeCategories.forEach(function(categoryId) {
                        $('.package-card[data-category="' + categoryId + '"]').show();
                    });
                } else {
                    $('.package-card').hide();
                    activeCategories.forEach(function(categoryId) {
                        activeTypes.forEach(function(typeId) {
                            $('.package-card[data-category="' + categoryId + '"][data-type="' + typeId +
                                    '"]')
                                .show();
                        });
                    });
                }
            } else if (activeCategories.length > 0) {
                $('.package-card').hide();
                activeCategories.forEach(function(categoryId) {
                    $('.package-card[data-category="' + categoryId + '"]').show();
                });
            } else if (activeTypes.length > 0) {
                if (activeTypes[0] === "all") {
                    location.reload();
                } else {
                    $('.package-card').hide();
                    activeTypes.forEach(function(typeId) {
                        $('.package-card[data-type="' + typeId + '"]').show();
                    });
                }
            } else {
                $('.package-card').show();
            }
        }

        $('.category-button').on('click', function() {
            toggleActive($(this));
            filterPackages();
        });

        $('.type-button').on('click', function() {
            toggleActive($(this));
            filterPackages();
        });
    </script>
@endsection
