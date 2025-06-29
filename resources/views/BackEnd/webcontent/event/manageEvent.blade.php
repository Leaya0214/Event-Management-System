@extends('BackEnd.master')

@section('content')
    <style>
        .child-table {
            width: 100%;
            border-collapse: collapse;
        }

        .child-table tbody tr td {
            padding-top: 0px !important;
            padding-bottom: 5px;
            padding-left: 20px;
            border-bottom: 1px solid #d9d6d6;
        }
        .btn-table tbody tr td {
            padding-top: 3px !important;
            padding-bottom: 0 !important;
            padding-left: 10px;
            border: none !important;
            /* border-bottom: 1px solid #d9d6d6; */
        }

        .main-table tbody tr td,
        .main-table thead tr th {
            padding: 0.85rem 0.85rem;
            text-align: left;
        }

        @media (min-width:1400px) {
            table td {
                /* padding-left: 0px ; */

            }

            .table> :not(caption)>*>*,
            .datepicker table> :not(caption)>*>* {
                padding: 0px;
            }
        }

        .hide {
            display: none;
        }
        ::placeholder {
            color: red;
            opacity: 1; /* Firefox */
        }

        ::-ms-input-placeholder { /* Edge 12-18 */
        color: red;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

      <div class="container">
        <h4 class="mb-4">Filter Event Data</h4>
        <div class="row">
            <div class="col-md-3">
                <select name="" id="status" class="form-select">
                    <option value="all">Select Status</option>
                    <option value="0">Pending</option>
                    <option value="1">Active</option>
                    <option value="2">Deactive</option>
                    <option value="3">Raw Ready For Delivery</option>
                    <option value="7">Raw Delivered</option>
                    <option value="4">Selection Given</option>
                    <option value="5">Final Ready</option>
                    <option value="6">Delivered</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="payment_status" class="form-select">
                    <option value="all">Select Payment Status</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="partial">Partial Paid</option>
                    <option value="full">Full Paid</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="event" id="filter-event" class="form-select chosen-select">
                    <option value="all">Select Booking Number</option>
                    @foreach ($events as $f_event)
                        <option value="{{ $f_event->id }}">{{ $f_event->booking_id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="district" id="district" class="form-select chosen-select">
                    <option value="all">Select District</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->district_id }}">{{ $district->district }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <select name="" id="type" class="form-select chosen-select">
                    <option value="all">Select Event Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="shift" class="form-select chosen-select">
                    <option value="all">Select Event Shift</option>
                    @foreach ($shifts as $shift)
                        <option value="{{ $shift->shift_id }}">{{ $shift->shift_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="category" class="form-select chosen-select">
                    <option value="all">Select Event Package</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="district" id="package" class="form-select chosen-select">
                    <option value="all">Select Event Package Type</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-3">
                <input type="text" class="form-control" id="from-date" placeholder="From Date"
                    onfocus="(this.type='date')">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="to-date" placeholder="To Date"
                    onfocus="(this.type='date')">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success" id="filter">Filter Data </button>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row pr-3">
                    <div class="col-md-6">
                        <h6 class="card-title">Events</h6>
                        <p class="text-muted mb-3">Manage All Events</p>
                    </div>
                </div>
                <div class="table-responsive pt-3" id="show">
                    <table class="table table-bordered main-table" data-table="true" id="eventTable">
                        <thead>
                             <tr>
                                <th>#</th>
                                <th>Booking No</th>
                                 <th>Event Date</th>
                                <th>Booking Info</th>
                                <th>Action</th>
                                <th>Add New</th>
                                <th>Status</th>
                                 <th>Payment Info</th>
                                <th>Assign</th>
                                <th>Add Expense</th>
                                <th>Event Type</th>
                                <th>Selection Date</th>
                                <th>Event Shift</th>
                                <th>Event Time</th>
                                <th>Package</th>
                                <th>Package Name</th>
                                 <th>Experience</th>
                                <th>Delivery Date</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                     <table class="table table-bordered main-table" data-table="true" id="selectionTable" style="display: none">
                        <thead>
                              <tr>
                                <th>#</th>
                                <th>Selection Date</th>
                                <th>Delivery Date</th>
                                <th>Booking No</th>
                                <th>Booking Info</th>
                                <th>Action</th>
                                <th>Add New</th>
                                <th>Add Expense</th>
                                <th>Status</th>
                                <th>Payment Info</th>
                                <th>Assign</th>
                                <th>Event Type</th>
                                <th>Event Date</th>
                                <th>Event Shift</th>
                                <th>Event Time</th>
                                <th>Package</th>
                                <th>Package Name</th>
                                 <th>Experience</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


     <style>
        .danger{
            background: rgb(218, 164, 164);
        }
        .warning{
            background: rgb(233, 233, 158);
        }
        .success{
            background: #79eb8f;
        }

    </style>
@endsection

@section('js')


<script type="text/javascript">

        $(document).ready(function (){
                load_data();
             $('#selectionTable').hide();

                function load_data(status = "", payment_status="", event = "", district = "", type = "", shift = "", category = "",
                    package = "", from_date = "", to_date = "") {
                        var table;
                        if(status == 4  ){
                              $('#eventTable').hide(); // Hide the first table
                             $('#selectionTable').show();
                            if (!$.fn.DataTable.isDataTable('#selectionTable')) {
                                table = $('#selectionTable').DataTable({
                                     processing: true,
                                    serverSide: true,
                                    deferRender: true,
                                    responsive: true,
                                    bLengthChange: false,
                                    searchDelay: 500,
                                    pageLength: 10,
                                    ajax: {
                                        url: '{!! route('allEvent') !!}',
                                        data: {
                                            status: status,
                                            payment_status: payment_status,
                                            event: event,
                                            district: district,
                                            type: type,
                                            shift: shift,
                                            category: category,
                                            package: package,
                                            from_date: from_date,
                                            to_date: to_date
                                        }
                                    },
                                    columns: [
                                        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                                        { data: 'selection_date', name: 'selection_date' },
                                        { data: 'delivery_date', name: 'delivery_date' },
                                        { data: 'booking_id', name: 'booking_id' },
                                        { data: 'booking_info', name: 'booking_info' },
                                        { data: 'action', name: 'action' },
                                        { data: 'add_new', name: 'add_new' },
                                        { data: 'expense', name: 'expense' },
                                        { data: 'status', name: 'status' },
                                        { data: 'payment_info', name: 'payment_info' },
                                        { data: 'assign', name: 'assign' },
                                        { data: 'event_type', name: 'event_type' },
                                        { data: 'event_date', name: 'event_date' },
                                        { data: 'event_shift', name: 'event_shift' },
                                        { data: 'event_time', name: 'event_time' },
                                        { data: 'package', name: 'package' },
                                        { data: 'package_name', name: 'package_name' },
                                          { data: 'experience', name: 'experience' },

                                    ],
                                     "createdRow": function(row, data, dataIndex) {
                                        var deliveryDate = new Date(data['delivery_date']);
                                        var currentDate = new Date();
                                        var diff = deliveryDate - currentDate;
                                        var diffDays = Math.floor(diff / (1000 * 60 * 60 * 24));

                                        if (diffDays < 0 || diffDays < 7) {
                                            $(row).addClass('danger');
                                        } else if (diffDays < 45) {
                                            $(row).addClass('warning');
                                        }
                                    },
                                    "scrollY": "400px",
                                    "scrollCollapse": true
                                });
                            }
                        }else{
                            $('#selectionTable').hide();
                            $('#eventTable').show(); // Hide the first table
                            if (!$.fn.DataTable.isDataTable('#eventTable')) {
                                var table = $('#eventTable').DataTable({
                                     processing: true,
                                    serverSide: true,
                                    deferRender: true,
                                    responsive: true,
                                    bLengthChange: false,
                                    searchDelay: 500,
                                    pageLength: 10,
                                    ajax: {
                                        url: '{!! route('allEvent') !!}',
                                        data: {
                                            status: status,
                                            payment_status: payment_status,
                                            event: event,
                                            district: district,
                                            type: type,
                                            shift: shift,
                                            category: category,
                                            package: package,
                                            from_date: from_date,
                                            to_date: to_date
                                        }
                                    },
                                    columns: [
                                        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false },
                                        { data: 'booking_id', name: 'booking_id' },
                                        { data: 'event_date', name: 'event_date' },
                                        { data: 'booking_info', name: 'booking_info' },
                                        { data: 'action', name: 'action' },
                                        { data: 'add_new', name: 'add_new' },
                                        { data: 'status', name: 'status' },
                                         { data: 'payment_info', name: 'payment_info' },
                                        { data: 'assign', name: 'assign' },
                                         { data: 'expense', name: 'expense' },
                                        { data: 'event_type', name: 'event_type' },
                                        { data: 'selection_date', name: 'selection_date' },
                                        { data: 'event_shift', name: 'event_shift' },
                                        { data: 'event_time', name: 'event_time' },
                                        { data: 'package', name: 'package' },
                                        { data: 'package_name', name: 'package_name' },
                                         { data: 'experience', name: 'experience' },
                                        { data: 'delivery_date', name: 'delivery_date' },

                                    ],
                                    "createdRow": function(row, data, dataIndex) {
                                        if (data['master_status'] == 2) { // Check if the event master status is 2
                                                $(row).addClass('success'); // Apply green color to rows where event master status is 2
                                            }

                                        if (data['delivery_date'] != null && data['delivery_date'] != '') {
                                            var deliveryDate = new Date(data['delivery_date']);
                                            var currentDate = new Date();
                                            var diff = deliveryDate - currentDate;
                                            var diffDays = Math.floor(diff / (1000 * 60 * 60 * 24));
                                            if (diffDays < 0 || diffDays < 7) {
                                                $(row).addClass('danger');
                                            } else if (diffDays < 45) {
                                                $(row).addClass('warning');
                                            }
                                        }

                                    },
                                     "scrollY": "500px",
                                     "scrollX": true,
                                    "scrollCollapse": true,

                                });
                            }
                        }
                }
                $('#filter').click(function () {
                    var status = document.getElementById('status').value;
                    var payment_status = document.getElementById('payment_status').value;
                    var event = document.getElementById('filter-event').value;
                    var district = document.getElementById('district').value;
                    var type = document.getElementById('type').value;
                    var shift = document.getElementById('shift').value;
                    var category = document.getElementById('category').value;
                    var package = document.getElementById('package').value;
                    var from_date = document.getElementById('from-date').value;
                    var to_date = document.getElementById('to-date').value;
                    var loading = "<img src='{{ asset('frontend/images/loading.gif') }}'>";
                    // $("#show").html(loading);
                    $('#loadingIndicator').show();
                    var urldata = '{!! route('allEvent') !!}';
                    $.ajax({
                    type: "GET",
                    url: urldata,
                    data: {
                        status,
                        payment_status,
                        event,
                        district,
                        type,
                        shift,
                        category,
                        package,
                        from_date,
                        to_date
                    },
                    success: function(data) {
                        $('#loadingIndicator').show();
                          $('#selectionTable').DataTable().destroy();
                            $('#eventTable').DataTable().destroy();
                        load_data(status,payment_status, event, district,type,shift,category,package,from_date,to_date)
                    $(".chosen-select").chosen();
                    }
                });
            });


         $(document).on('click', '.load-modal', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const modalId = $(this).data('bs-target');

                $.get(url, function (html) {
                    $('body').append(html);
                    const modalElement = document.querySelector(modalId);
                    if (modalElement) {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();

                        modalElement.addEventListener('hidden.bs.modal', function () {
                            modalElement.remove();
                        });
                    } else {
                        console.error('Modal element not found:', modalId);
                    }
                }).fail(function (error) {
                    console.error('Error loading modal content:', error);
                });
            });


            $(document).on('click', '.status-modal', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const target = $(this).data('bs-target');

                if (!$(target).length) {
                    $.get(url, function(response) {
                        $('body').append(response);
                        new bootstrap.Modal(document.querySelector(target)).show();
                    });
                } else {
                    new bootstrap.Modal(document.querySelector(target)).show();
                }
            });

            $(document).on('click', '.view-modal', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const target = $(this).data('bs-target');

                if (!$(target).length) {
                    $.get(url, function(response) {
                        $('body').append(response);
                        new bootstrap.Modal(document.querySelector(target)).show();
                    });
                } else {
                    new bootstrap.Modal(document.querySelector(target)).show();
                }
            });

            $(document).on('click', '.log-modal', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const target = $(this).data('bs-target');

                if (!$(target).length) {
                    $.get(url, function(response) {
                        $('body').append(response);
                        new bootstrap.Modal(document.querySelector(target)).show();
                    });
                } else {
                    new bootstrap.Modal(document.querySelector(target)).show();
                }
            });

            $(document).on('click', '.officeExperience-modal', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const target = $(this).data('bs-target');

                if (!$(target).length) {
                    $.get(url, function(response) {
                        $('body').append(response);
                        new bootstrap.Modal(document.querySelector(target)).show();
                    });
                } else {
                    new bootstrap.Modal(document.querySelector(target)).show();
                }
            });

            $(document).on('click', '.viewExperience-modal', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const target = $(this).data('bs-target');

                if (!$(target).length) {
                    $.get(url, function(response) {
                        $('body').append(response);
                        new bootstrap.Modal(document.querySelector(target)).show();
                    });
                } else {
                    new bootstrap.Modal(document.querySelector(target)).show();
                }
            });

        });


    </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>

</script>
<script>
        function filterCategory(e, detailId) {
            $('#hideDiv1-' + detailId).hide();
            $('#hideDiv2-' + detailId).hide();
            $('#hideDiv3-' + detailId).hide();
            $('#hideDiv4-' + detailId).hide();
            var user_id = e.value;
            var parts = user_id.match(/^(\d+)([a-zA-Z]+)$/);
            var experienceLevel = parts[2];
            if (experienceLevel === 'Freelancer') {
                $('#hideDiv1-' + detailId).show();
                $('#hideDiv2-' + detailId).show();
                $('#hideDiv3-' + detailId).show();
                $('#hideDiv4-' + detailId).show();
            }
        }

        function filterAppendCategory(e, detail_id, serial) {
            $('#append1-' + detail_id + serial).hide();
            $('#append2-' + detail_id + serial).hide();
            $('#append3-' + detail_id + serial).hide();
            $('#append4-' + detail_id + serial).hide();
            var user_id = e.value;
            var parts = user_id.match(/^(\d+)([a-zA-Z]+)$/);
            var experienceLevel = parts[2];
            if (experienceLevel === 'Freelancer') {
                $('#append1-' + detail_id + serial).show();
                $('#append2-' + detail_id + serial).show();
                $('#append3-' + detail_id + serial).show();
                $('#append4-' + detail_id + serial).show();
                $('')
            }
        }
    </script>
    <script>
            function calculateDueAmount(e) {
                let text = e.id;
                let id = text.replace('advance', '');
                let totalAmount = parseFloat($('#payment'+id).val()) || 0;
                let advanceAmount = parseFloat($('#advance'+id).val()) || 0;
                let dueAmount = totalAmount - advanceAmount;
                $('#due'+id).val(dueAmount);
            }
    </script>

    <script>
        function filterEventData(){
            var status = document.getElementById('status').value;
            var event = document.getElementById('filter-event').value;
            var district = document.getElementById('district').value;
            var type = document.getElementById('type').value;
            var shift = document.getElementById('shift').value;
            var category = document.getElementById('category').value;
            var package = document.getElementById('package').value;
            var from_date = document.getElementById('from-date').value;
            var to_date = document.getElementById('to-date').value;
            var loading = "<img src='{{asset('frontend/images/loading.gif')}}'>";
		        $("#show").html(loading);
            var urldata = "{{route('filterEvent')}}";
            $.ajax({
                type: "GET",
                url: urldata,
                data: { status, event, district,type,shift,category,package,from_date,to_date},
                success: function (data) {
                    $("#show").html(data);
                    $(".chosen-select").chosen();
                }
            });
        }
    </script>

       <script>
        function deleteData(id) {
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: '/event/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var table = $('#eventTable').DataTable();
                    var currentPage = table.page();
                        var rowToDelete = table.row($('.delete[data-id="' + id + '"]').closest('tr'));
                        if (rowToDelete.length) { // Check if row exists before removal
                            rowToDelete.remove().draw();
                            if (currentPage > 0) {
                                table.page(currentPage).draw('page');
                            }
                        } else {
                            console.warn('Row with ID ' + id + ' not found in DataTable');
                        }
                },
                error: function(xhr) {
                    console.error('Error deleting data:', xhr.responseText);
                }
            });
        }
    }
        function deleteEvent(id) {
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: '/event/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var table = $('#selectionTable').DataTable();
                    var currentPage = table.page();
                    var rowToDelete = table.row($('.delete[data-id="' + id + '"]').closest('tr'));
                    if (rowToDelete.length) {
                        rowToDelete.remove().draw();
                        if (currentPage > 0) {
                                table.page(currentPage).draw('page');
                        }
                    } else {
                        console.warn('Row with ID ' + id + ' not found in DataTable');
                    }
                },
                error: function(xhr) {
                    console.error('Error deleting data:', xhr.responseText);
                }
            });
        }
    }
    </script>

<script>
     function deleteassignUser(id) {
        if (confirm('Are you sure you want to delete this data?')) {
            $.ajax({
                url: '/deleteAssignUser/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var rowToDelete = document.querySelector('#assignUserTable tr[data-id="' + id + '"]');
                    if (rowToDelete) {
                        rowToDelete.remove();
                        const messageElement = document.getElementById('success-message');
                        messageElement.textContent = 'User successfully deleted!';
                        messageElement.style.display = 'block';
                                                setTimeout(() => {
                            messageElement.style.display = 'none';
                        }, 3000);
                    } else {
                        console.warn('Row with ID ' + id + ' not found in Table');
                    }
                },
                error: function(xhr) {
                    console.error('Error deleting data:', xhr.responseText);
                }
            });
        }
    }
</script>


@endsection
