@extends('welcome')

<style>
    .form-row {
        padding-left: 30% !important;
        padding-right: 0 !important;
    }

    .contact-form h2 {
        text-align: center;
        font-size: 25px;
        font-weight: 400;
        margin: 10px auto;
    }

    .contact-form h3 {
        font-size: 20px;
        font-weight: 400;
        margin: 8px;
    }


    .button {
        padding: 10px;
        background: #100e07;
        color: white;
        width: 50%;
        font-size: 18px;
    }

    .contact-us-section .events-wrapper .event-start-div,
    .contact-us-section .events-wrapper .event-end-div {
        width: 100%;
        max-width: 244px;
        clear: both;
        box-sizing: border-box;
    }

    .contact-us-section .events-wrapper .event-start-div {
        width: 42%;
        display: inline-block;

    }

    .contact-us-section .events-wrapper .event-start-div p {
        font-size: 17px;
        font-weight: 400;
        font-family: 'Philosopher', sans-serif;
    }

    .contact-us-section .events-wrapper .event-end-div {
        display: inline-block;
        width: 58%;
    }

    .contact-us-section .events-wrapper small {
        font-size: 13px;
        font-family: 'Philosopher', sans-serif;
        margin-left: 110px;
    }

    .contact-us-section .events-wrapper .to-date {
        width: 5%;
        display: inline-block;
        margin: 1rem;
    }
    .hide{
        display: none;
    }

    @media screen and (max-width: 639px) {
        .form-row {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .contact-us-section .events-wrapper .event-start-div,
        .contact-us-section .events-wrapper .event-end-div {
            width: 100%;
            max-width: 244px;
            clear: both;
            box-sizing: border-box;
        }

        .contact-us-section .events-wrapper .event-start-div {
            width: 35%;
            padding-top: 7px;
        }

        .contact-us-section .events-wrapper .event-start-div p {
            font-size: 15px;
            font-weight: 400;
            font-family: 'Philosopher', sans-serif;
        }

        .contact-us-section .events-wrapper .event-end-div {
            width: 60%;
        }

        .contact-us-section .events-wrapper small {
            font-size: 11.5px;
            font-family: 'Philosopher', sans-serif;
            margin-left: 13px;
        }


    }

    @media only screen and (min-width: 768px) and (max-width: 960px) {
        .form-row {
            padding-left: auto !important;
            padding-right: auto !important;
        }
    }

    @media screen and (max-width: 1024px) {
        .form-row {
            padding-left: auto !important;
            padding-right: auto !important;
        }


    }

    .checkbox-container {
        display: flex;
        align-items: center;
    }

    .checkbox-container input {
        margin-right: 10px;
    }

    .checkbox-container label {
        padding-top: 5px;
        padding-left: 10px;
        padding-right: 25px;
        font-size: 11px;
    }
</style>
@section('content')
    <section class="contact-us-section animatedParent animateOnce ng-scope">
        <form action="{{ route('booking.store') }}" id="myForm" class="contact-form ng-pristine ng-valid ng-valid-email "
            method="POST" onsubmit="return validateForm()">
            @csrf
            <div class="row animated fadeIn go form-row">
                <div class="col s12 m6 l6">
                    <h2>Client Details <span style="color: red">*</span> </h2>
                    <div>
                        <input type="text" name="client_name" id="client_name" placeholder="Client Full Name"
                            class="ng-pristine ng-untouched ng-valid ng-empty">
                    </div>
                    <div>
                        <input type="text" name="address" id="address" placeholder="Client Full Address"
                            class="ng-pristine ng-untouched ng-valid ng-empty">

                    </div>
                    <div>
                        <input type="text" name="primary_no" id="primary_no" placeholder="Primary Phone No."
                            class="phone-guest ng-pristine ng-untouched ng-valid ng-empty">

                        <input type="text" name="alternate_no" id="alternate_no" placeholder="Alternate Phone No."
                            class="phone-guest guest2 ng-pristine ng-untouched ng-valid ng-empty">

                        <div class="guest-errors">
                            <div class="error-message">
                            </div>
                            <div class="error-message">
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="text" name="email" id="email" placeholder="Email Address."
                            class="ng-pristine ng-untouched ng-valid ng-empty">
                    </div>

                    <h2 style="padding: 20px 0">Event Details <span style="color: red">*</span> </h2>
                    <div class="events-wrapper">
                        <div class="event-start-div">
                            <p> Total Number Of Events </p>
                        </div>

                        <div class="event-end-div">
                            <select class="ng-pristine ng-untouched ng-valid ng-empty" name="total_event" id="total_number"
                                placeholder="Total Number Of Event">
                                <option selected disabled>Number of Event</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </div>
                        <small>Please Select Total Number of Events you want us to book</small>

                    </div>

                    <div id="dynamicElementsContainer">
                    </div>

                    <h2 style="padding: 20px 0">BRIDE/GROOM Details <span style="color: red">*</span> </h2>

                    <div>
                        <input type="text" name="bride_name" placeholder="Bride Name" id="bride_name"
                            class="ng-pristine ng-untouched ng-valid ng-empty ">
                    </div>
                    <div>
                        <input type="text" name="groom_name" placeholder="Groom Name" id="groom_name">
                    </div>

                    <h2 style="padding: 20px 0">Payment Details <span style="color: red">*</span> </h2>

                   <div>
                        <input type="number" name="payment_amount" id="payment_amount" placeholder="Total Final Amount"
                            required>
                    </div>
                    <div>
                        <input type="number" name="advance" id="advance" placeholder="Advance"
                            class="ng-pristine ng-untouched ng-valid ng-empty ng-valid-email">
                    </div>
                    <div>
                        <input type="number" name="due_amount" id="due" placeholder="Due Amount"
                            class="ng-pristine ng-untouched ng-valid ng-empty ng-valid-email">
                    </div>
                    <div>
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="payment_method" id="payment_method"
                            placeholder="Package Type" onchange="selectPayment()">
                            <option selected disabled>Payment System</option>
                            <option value="cash">Cash</option>
                            <option value="bKash">bKash</option>
                            <option value="bank">Bank</option>

                        </select>
                    </div>
                    <div>
                        <input type="text" name="transaction_id" id="transaction_id"
                            placeholder="Type bKash Transaction ID">
                    </div>
                    <div>
                        <input type="text" name="account_number" id="account_number"
                            placeholder="Type Bank Account Number">
                    </div>
                    <div>
                        <input name="payment_date"  required="" type="text" placeholder="Payment Date" id="date"
                        onfocus="(this.type='date')" class="ng-pristine ng-untouched ng-valid ng-empty">
                    </div>
                    <div>
                        <textarea id="instructions" name="instructions" rows="5" placeholder="Any Other Instruction"
                            class="ng-pristine ng-untouched ng-valid ng-empty"></textarea>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="termsAndCondition" onchange="toggleSubmitButton()" required>
                        <label for="termsAndCondition" id="openModal">I Certify that I am above 18 years old and I agree to the Terms &
                            Conditions and Privacy Policy</label>
                        <button class="button" id="submitButton" type="submit" >Submit</button>
                    </div>


                </div>
            </div>
        </form>
        <div class="success-notification-popup hide-popup">
            <p class="ng-binding"></p>
        </div>
<style>
.modal-box {
    position: fixed;
    top: 10;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent background */
    z-index: 9999; /* Ensure the modal is on top of other content */
    overflow-y: auto; /* Allow vertical scrolling if content exceeds viewport height */
}

.modal-info {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff; /* Background color of the modal */
    padding: 5px;
    border-radius: 5px;
    max-width: 80%; /* Adjust the maximum width of the modal content */
    overflow-y: auto; /* Make the content scrollable vertically */
    max-height: 90%;
}

.modal-contents {
    max-height: calc(100% - 40px); /* Set a maximum height for the modal content */
    overflow-y: auto; /* Make the content scrollable vertically */
}

/* Additional styles for header and footer */
.modal-info header,
.modal-info footer {
    text-align: center;
}
h3{
    font-size: 20px;
    text-align: center;
}
p{
    text-align: center;
}
.description{
    padding: 0 !important;
}
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #333;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 30px;
    font-weight: bold;
}

.close-btn:hover {
    background-color: #ddd;
}

</style>
        <div class="hide">

                <div class="modal-box" id="terms"
                    data-ng-controller="careerController">
                    <div class="modal-info">
                        <button type="button" class="close-btn" onclick="closeModal()"><span class="fs-2" aria-hidden="true">&times;</span></button> 
                        <div class="modal-contents">
                            <div class="description">
                                <header>
                                    <h1>Terms and Conditions</h1>
                                </header>
                                
                                <div class="container">
                                    <h3>Event Timing</h3>
                                    <p>Days Shift ( 12.30pm-5.30pm ) & Evening Shift ( 7pm-12.00pm )</p>
                                       <p> If client need more time (depends on availability) we can provide it but extra shift charges & door to
                                        door safe transportation will be applicable on that time. Extra shift Charge: 3,000 Taka per
                                        Photographer/hour & 3,000 Taka per Cinematographer/hour.</p>
                                        <p style="margin-bottom: 13px">For Riazul Islam Shawon Extra 1 hour Charge is 6,000 Taka..</p>
                                
                                    <h3>Bashor / Pre Event / Get Ready Shoot</h3>
                                    <p style="margin-bottom: 13px">For Bashor, Preparation, Parlor, Home-based shoot will take extra charges (Per Photographer 3,000
                                        taka/hour & Per Cinematographer 3,000 Taka/hour. But Client must confirm this at least 3 days
                                        before event.</p>
                                
                                    <h3>Transportation (For Out Side Dhaka & Chittagong Metropolitan Area)</h3>
                                    <p style="margin-bottom: 13px">Client have to provide safe transportation for reaching venue. Like AC Bus, By Air, Train AC
                                        Compartment, Launch AC Compartment. If client don't want to arrange client must pay all cost.
                                        </p>
                                
                                    <h3>Payment System</h3>
                                    <p style="margin-bottom: 13px">50% charge client (Nonrefundable) have to pay at final booking date, rest 50% must pay at event date
                                        within 2 hours from event starting. There is no option to delay this payment.
                                        </p>
                                
                                    <h3>Final Delivery System</h3>
                                    <p>Client can collect his raw photo & video within 5 days from event day. We need minimum 30-40
                                        working days (If Client Give us selection), 40-50 working days (If Bridal Harmony Team select) time to
                                        deliver all edited and printed copies, if there are more than one event of a client then delivery will
                                        extend by 10 days’ time for per event. (This day counting starts from the day client provide the
                                        photo/song selection). If client failed to give us selection within 3-5 days from raw collection, then it
                                        may be delayed to deliver. Our weekly off day is only Friday. Gov’t Holiday is not considering as
                                        working day.
                                        </p>
                                    <h3>Footage Keeping</h3>
                                    <p>Bridal Harmony will keep clients Raw footage maximum 60 days from event date & Final Edited file &
                                        other things like : Pen drive, Printed Photos, Hard Drive 45 days from final work completed. 
                                        </p>
                                    <h3>Pre / Post Event Shoot </h3>
                                    <p>If a client need any pre/post wedding couple photo-shoot (Depends on packages) client can take it
                                        any day without Friday & Govt. Holiday. But client have to let us know about it at least 7 days before
                                        the shoot. Have to organize it outdoor & within Dhaka metropolitan area where no need to take any
                                        permission for photo-shoot.
                                        </p>

                                    <h3>Timing for Good Photographs & Video</h3>
                                    <p>For Portrait & Conceptual photography and cinematography we need at least 40 minutes time with
                                        Bride, 25 minutes time with groom and 40 minutes time with Bride & Groom both without any
                                        interruption before guest call time. If client failed to give that much time on that day to the
                                        Photographer & Cinematographer then Bridal Harmony & his team is not responsible for picture &
                                        video quality
                                        </p>

                                        <h3>About Packages </h3>
                                        <p>We have all talented Photographers & Cinematographers. But based on their work we divide them in
                                            2 categories. Top Photographer / Top Cinematographer & Senior Photographer / Senior
                                            Cinematographer. Our top photographers shoot is definitely good but senior photographers are best.
                                            Because senior photographers have more experience than top photographer. So if you need good
                                            output we suggest take our Senior Photographer / Cinematographer. If you need best output then
                                            take Signature series with our Chief Photographer Riazul Islam Shawon. If you want story telling things
                                            with cinematic output then definitely you have to select our Rupkotha Series. If client need to
                                            coverage of total event, client have to select more than 1 photographer & cinematograp</p>

                                        <h3>About Re-Editing</h3>
                                        <p>If client doesn't like our post processing (Editing) client must let us know about this we will definitely
                                            re edit all those. But client have to let us know about the problem of our post processing.</p>
                                        <p>If client doesn't give us selection then re-editing is not applicable. Re-Editing is applicable only Single
                                            time. After single re-editing client have to pay for another one.</p>

                                        <h3>Unprofessional Behavior</h3>
                                        <p>If we find any kind of misbehave, harassment, hassle in a program with any of our Bridal Harmony
                                            team member, we will stop our work on that spot on that time. If client find any problem from us he
                                            must communicate with Bridal Harmony Authority immediately, we will take action (If client does not
                                            contact immediately, Bridal Harmony do not take any kind of complain later).</p>

                                    <h3>Social Media / Other Media Sharing</h3>
                                    <p>Portfolio purpose Bridal Harmony can publish your events photo or video to social / other media.</p>

                                    <h3>Additional Charge (For Out Side Dhaka & Chittagong Metropolitan Area)</h3>
                                    <p>15% shift charge (Package Price) will be added with package price</p>

                                    <h3>Accommodation (For Out Side Dhaka & Chittagong Metropolitan Area)</h3>
                                    <p>If our team have to stay or if they reached clients location before event, client must be arrange
                                        accommodation for our team. Like: Hotel/Safe House.</p>

                                    <h3>Event cancelation</h3>
                                    <p style="margin-bottom:30px">If you book us once you can cancel your booking before 72 hours from your event. But your advance
                                        will be non-refundable. If you want to cancel your booking within 72 hours from your events date you
                                        have to pay 50% of package money for that package/day.
                                        </p>
                                </div>
                                
                                <footer>
                                    <p>&copy; 2024 Bridal Harmony. All rights reserved.</p>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </section>
@endsection
@section('js')
<script>
    $(document).ready(function(){
      
    $('#openModal').click(function(){
      
        $.colorbox({
            inline: true,
            href: '#terms',
            width: '95%',
            maxWidth: '800px',
            height: 'auto',
            fixed: true,
            transition: 'none'
        });
      
    });
});
</script>
    <script>
        function toggleSubmitButton() {
        var termsCheckbox = document.getElementById('termsAndCondition');
        var submitButton = document.getElementById('submitButton');

        if (termsCheckbox.checked) {
            submitButton.disabled = false; 
        } else {
            submitButton.disabled = true; 
        }
    }
    function closeModal() {
    document.getElementById('terms').style.display = 'none'; // Hide the modal
}
    </script>
    <script>
        $('#transaction_id').hide();
        $('#account_number').hide();

        function selectPayment() {
            let payment_method = document.getElementById('payment_method').value;
            if (payment_method == 'cash') {
                $('#transaction_id').hide();
                $('#account_number').hide();
            } else if (payment_method == 'bKash') {
                $('#transaction_id').show().prop('required', true);
                $('#account_number').hide();
            } else {
                $('#account_number').show().prop('required', true);;
                $('#transaction_id').hide();
            }
        }

        $("#total_number").on("change", function() {
            const total_number = $(this).val();
            console.log(total_number);
            const container = $("#dynamicElementsContainer");
            const package_type = @json($package_type);
            const package = @json($package);
            container.empty();
            if (total_number < 11) {
                for (let i = 0; i < total_number; i++) {
                    const event = i + 1;
                    const dynamicElement = `
                    <h3 ><b>Event ` + event +
                        `</b></h3>

                    <div>
                        <input name="date[]" required="" type="text" placeholder="Event Date" id="date" value="@php echo date("Y-m-d") @endphp"
                            onfocus="(this.type='date')" class="ng-pristine ng-untouched ng-valid ng-empty">
                    </div>
                    <div>
                       
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="shift_id[]" id="shift_id"
                            placeholder="">
                                @foreach ($shifts as $shift)
                                <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                                @endforeach
                        </select>
                        <!-- ngIf: errors.groom_name -->
                    </div>
                    <div class="workshop-dates-wrapper ">
                       
                        <p>Event Time </p>
                        <div class="workshop-start-date">

                            <input type="time" name="start_time[]" id="start_time"
                                class="" value="@php echo date('H:i'); @endphp">
                        </div>

                        <div class="to-date">
                            <p>To </p>
                        </div>

                        <div class="workshop-end-date">
                            <input type="time" name="end_time[]" id="end_time" placeholder="DD/MM/YY"
                                class="dates ng-pristine ng-untouched ng-valid ng-empty hasDatepicker" value="@php echo date('H:i'); @endphp">
                        </div>
                        <div class="workshop-dates-errors">
                            <div class="error-message">
                            </div>
                            <div class="error-message">
                            </div>
                        </div>
                    </div>
                    <div>
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="type_id[]" id="type_id"
                            placeholder="">
                            @foreach ($types as $type)
                                <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="district_id[]" id="district_id"
                            placeholder="" onchange="filterPackage(this)">
                            @foreach ($districts as $district)
                                <option value="{{ $district->district_id }}">{{ $district->district }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div>
                        <textarea id="venue" name="venue[]" rows="3" placeholder="Event Location / Venue"
                            class="ng-pristine ng-untouched ng-valid ng-empty"></textarea>
                        <!-- ngIf: errors.location_description -->
                    </div>
                    <div>
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="category_id[]" id="category_id_` + i +
                        `"
                            placeholder="Package Type" onchange="filterPackage(this)">
                            @foreach ($package_category as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <select class="ng-pristine ng-untouched ng-valid ng-empty" name="package_id[]" id="package_id_` + i + `"
                            placeholder="Package Type" onchange="letAmount(this)" >
                            @foreach ($package as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="margin-top:">
                        <label><h4 style="font-size:14px;text-weight:bold">Add Ons(Optional)</h4></label>
                        <textarea id="add_ons" name="add_ons[]" rows="4" placeholder="Type Add Ons Here"
                            class="ng-pristine ng-untouched ng-valid ng-empty"></textarea>
                    </div>`
                    container.append(dynamicElement);
                }
            } else if (total_number > 3) {
                alert("Can Not Book More Than 10");
                container.empty();
                $(this).val("");
            } else {
                container.empty();
            }
        });
    </script>

    <script>
        function validateForm() {
            const clientName = document.getElementById('client_name').value;
            const address = document.getElementById('address').value;
            const primaryNo = document.getElementById('primary_no').value;
            const alternateNo = document.getElementById('alternate_no').value;
            const email = document.getElementById('email').value;
            const eventDate = document.getElementById('date').value;
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const brideName = document.getElementById('bride_name').value;
            const groomName = document.getElementById('groom_name').value;
            const paymentAmount = document.getElementById('payment_amount').value;
            const advance = document.getElementById('advance').value;

            if (clientName.trim() === '') {
                alert('Please Enter Your Name');
                return false
            }
            if (address.trim() === '') {
                alert('Please Enter Your Address');
                return false
            }

            if (primaryNo.trim() === '') {
                alert('Please Enter Your Phone Number');
                return false
            }

            if (alternateNo.trim() === '') {
                alert('Please Enter An Alternate Phone Number');
                return false
            }
            if (eventDate.trim() === '') {
                alert('Please Enter Date');
                return false
            }
            if (startTime.trim() === '') {
                alert('Please Enter Event Start Time');
                return false
            }
            if (endTime.trim() === '') {
                alert('Please Enter Event End Time');
                return false
            }
            if (brideName.trim() === '') {
                alert('Please Enter Bride Name');
                return false
            }
            if (groomName.trim() === '') {
                alert('Please Enter Groom Name');
                return false
            }

            if (email === '') {
                alert('Please Enter Email address');
                return false

            } else if (!isValidEmail(email)) {
                alert('Please enter a valid email address');
                return false
            } else {
                console.log('ok');
                return true
            }

            return true
            $.ajax({
                url: "{{ route('booking.store') }}",
                method: 'POST',
                data: $('#myForm').serialize(),
                success: function(response) {
                    // Handle the success response
                    if (response.success) {
                        alert(response.success);
                    }
                },
                error: function(error) {
                    // Handle the error response
                    alert('Error submitting data!');
                }
            });

        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
    <script>
        let now = new Date();
        now.setHours(9);
        now.setMinutes(0); 

        let defaultTime = now.toLocaleTimeString('en-US', {hour12: false});
        document.getElementById("start-time").value = defaultTime;
        document.getElementById("end-time").value = defaultTime;
    </script>
    <script>
        function filterPackage(e) {
            const text = e.id;
            const id = text.replace('category_id_', '');
            const district = document.getElementById('district_id').value;
            const category_id = document.getElementById('category_id_' + id).value;
            var allPackageIds = [];

            $.ajax({
                url: '{{ route('filterPackage') }}',
                data: {
                    category_id: category_id,
                    district : district
                }, // Sending data in key-value format
                type: 'GET',
                success: function(res) {
                    $('#package_id_' + id).html('');
                    $.each(res, function(key, value) {
                        $('#package_id_' + id).append('<option value="' + value.id + '">' + value.name +
                            '</option>');

                    });

                },
                error: function(err) {
                    alert('No data );');
                }
            });


        }

        function letAmount(e) {
            const text = e.id;
            const id = text.replace('package_id_', '');
            const package_id = document.getElementById('package_id_' + id).value;
            let total_amount = 0;

            // Create an array to store promises from AJAX requests
            let ajaxPromises = [];

            $('[id^="package_id_"]').each(function() {
                const currentPackageId = $(this).val();

                if (currentPackageId) {
                    let ajaxPromise = $.ajax({
                        url: '{{ route('packageDetails') }}',
                        data: {
                            package_id: currentPackageId
                        },
                        type: 'GET',
                    }).then(function(packageData) {
                        let selectedPackagePrice = parseFloat(packageData.discount);
                        if (!isNaN(selectedPackagePrice)) {
                            total_amount += selectedPackagePrice;
                        } else {
                            console.error('Invalid package amount:', packageData.discount);
                        }
                    }).fail(function(err) {
                        console.error('Error fetching package details');
                    });

                    ajaxPromises.push(ajaxPromise);
                }
            });

            $.when.apply($, ajaxPromises).then(function() {

                $('#advance').on('keyup', function() {
                    calculateDueAmount();
                });

                updateTotalAmount(total_amount);
            });

        }

        function updateTotalAmount(amount) {
            $('#payment_amount').val(amount);
            $('#due').val(amount);

        }


        function calculateDueAmount() {
            let totalAmount = parseFloat($('#payment_amount').val()) || 0;
            let advanceAmount = parseFloat($('#advance').val()) || 0;
            let dueAmount = totalAmount - advanceAmount;
            $('#due').val(dueAmount);
        }
    </script>
@endsection
