@extends('BackEnd.master')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display{
        padding-left: 15px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{
        background: transparent;
        color: white;
    }
</style>
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title col-sm-11">
                        Account Category List
                    </h3>
                    @can('account.category.add')
                    <button class="col-sm-1 btn btn-success btn-sm"  data-toggle="modal"
                    data-target="#exampleModal" >+Add</button> 
                    @endcan
                </div> <!-- /.card-body -->
                <div class="card-body p-3">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-primary" >
                            <tr>
                                <th class="text-white">ID</th>
                                <th class="text-white">Category Name</th>
                                <th class="text-white">Category Type</th>
                                <th class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:14px;">
                            @php $i = 0; @endphp
                          @foreach($categories as $category)
                          @php $category_type = json_decode($category->category_type) @endphp
                          <tr>
                            <td>{{++$i}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->type}}</td>
                            <td>
                                @can('account.category.edit')
                                <a data-toggle="modal"
                                    data-target=".update-modal-{{$category->id}}"
                                    style="padding:2px; color:white" class="btn btn-xs btn-info  mr-1">
                                    <svg width="16" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                              
                                @if ($category->status == 1) 
                                   <a href='{{route('category.status',$category->id)}}' style='padding:2px;'
                                        class='btn btn-xs btn-success btn-sm mr-1'>
                                        <svg  width='16' height='14' viewBox='0 0 24 24'
                                            fill='none' stroke='currentColor' stroke-width='2'
                                            stroke-linecap='round' stroke-linejoin='round'
                                            class='feather feather-arrow-up'>
                                            <line x1='12' y1='19' x2='12' y2='5'>
                                            </line>
                                            <polyline points='5 12 12 5 19 12'></polyline>
                                        </svg></a>
                                @else
                                <a href="{{route('category.status',$category->id)}}"
                                    style='padding:2px;background-color:rgb(202, 63, 82); color:white'
                                    class='btn btn-xs btn-sm mr-1'><svg width='16' height='14'
                                        viewBox='0 0 26 26' fill='none' stroke='currentColor'
                                        stroke-width='2' stroke-linecap='round' stroke-linejoin='round'
                                        class='feather feather-arrow-down'>
                                        <line x1='12' y1='5' x2='12' y2='19'>
                                        </line>
                                        <polyline points='19 12 12 19 5 12'></polyline>
                                    </svg></a>
                                @endif
                                @endcan
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        <div class="col-lg-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination ">
                                    {{$categories->links('pagination::bootstrap-4')}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade create_modal" id="exampleModal"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-center">
                <h5 >Add Account Category</h5>
                <button type="button" class="close"
                data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                   <div class="form-group row pt-3">
                        <label for="category_name" class="col-sm-3 col-form-label">Category Name</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-8">
                            <input name="category_name" type="text" class="form-control" placeholder="Type Category_name............" required>
                        </div>
                    </div>
                   <div class="form-group row pt-3">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-8">
                            <select name="type" id="" class="form-control" required>
                                <option value=""> <--------- Select Type ----------> </option>
                                <option value="Expense">Expense</option>
                                <option value="Income">Income</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

@foreach($categories as $category)

<div class="modal fade update update-modal-{{$category->id}}" id="exampleModal"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-center">
                <h5 >Update Account Category</h5>
                <button type="button" class="close"
                data-dismiss="modal">&times;</button>
            </div>
            <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                   <div class="form-group row pt-3">
                        <label for="category_name" class="col-sm-3 col-form-label">Category Name</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-8">
                            <input name="category_name" type="text" class="form-control" value="{{$category->name}}" placeholder="Type Category_name............">
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="type" class="col-sm-3 col-form-label">Type</label>
                        <label for="" class="col-sm-1 col-form-label">:</label>
                        <div class="col-sm-8">
                            <select name="type" id="" class="form-control" required>
                                <option value=""> <--------- Select Type ----------> </option>
                                <option value="Expense" @if($category->type == 'Expense') selected @endif >Expense</option>
                                <option value="Income"  @if($category->type == 'Income') selected @endif>Income</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('.create_modal').on('shown.bs.modal', function () {
            $('.js-example-basic-multiple').select2();
        });
        $('.update').on('shown.bs.modal', function () {
            $('.js-example-basic-multiple').select2();
        });
    });
</script>