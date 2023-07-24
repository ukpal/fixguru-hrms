@extends('layout')

{{-- @section('style')
@parent
@endsection --}}

@section('content')
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Users</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('users.all')}}">Users</a></li>
                        <li class="breadcrumb-item active"><a>Add</a></li>
                    </ul>
                </div>
                {{-- <div class="col-md-6 col-sm-12 text-md-end">
                    <div class="d-inline-flex text-start">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-user"></i> 1,784</h6>
                            <small>Visitors</small>
                        </div>
                        <span id="bh_visitors"></span>
                    </div>
                    <div class="d-inline-flex text-start ms-lg-3 me-lg-3 ms-1 me-1">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-globe"></i> 325</h6>
                            <small>Visits</small>
                        </div>
                        <span id="bh_visits"></span>
                    </div>
                    <div class="d-inline-flex text-start">
                        <div class="me-2">
                            <h6 class="mb-0"><i class="fa fa-comments"></i> 13</h6>
                            <small>Chats</small>
                        </div>
                        <span id="bh_chats"></span>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Add User</h6>
                        <ul class="header-dropdown">
                            <li><a type="button" href="{{route('users.all')}}" class="btn btn-outline-danger">Back</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="basic-form" action="{{route('users.store')}}" method="post" novalidate="">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="employee">Select Employee <small class="text-danger">*</small></label>
                                <select name="employee" id="employee" class="form-control @error('employee') is-invalid @enderror">
                                    <option value="">select an employee</option>
                                    @foreach ($emps as $item)
                                        <option value="{{$item->id}}">{{$item->fname.' '.$item->lname}}</option>
                                    @endforeach
                                </select>
                                @error('employee')
                                    <small class="text-danger" data-error='employee'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="role">Select User Type <small class="text-danger">*</small></label>
                                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">select option</option>
                                    <option value="SA">Super User</option>
                                    <option value="HE">HE User</option>
                                </select>
                                @error('role')
                                    <small class="text-danger" data-error='role'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="username">Username <small class="text-danger">*</small></label>
                                <input type="text" maxlength="50"  id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                                @error('username')
                                <small class="text-danger" data-error='username'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="password">Password <small class="text-danger">*</small></label>
                                <input type="password" maxlength="200" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                                @error('password')
                                <small class="text-danger" data-error='password'>{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
@parent
<script type="text/javascript">
    $(function () {
        $("#departments").select2({
            placeholder: 'select departments',
        });
        $("#designations").select2({
            placeholder: 'select designations',
        });
        $("#skills").select2({
            placeholder: 'select skills',
        });
        $("#employment_type").select2({
            placeholder: 'select employment types',
        });
        $("[name='first_name']").on("focus",function(){
            $(this).alpha();
            $("[data-error='first_name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='last_name']").on("focus",function(){
            $(this).alpha();
            $("[data-error='last_name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='gender']").on("focus",function(){
            $("[data-error='gender']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='phone']").on("focus",function(){
            $(this).alphanum({
                allow:',',
                allowLatin: false
            });
            $("[data-error='phone']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='father_name']").on("focus",function(){
            $("[data-error='father_name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='permanent_address']").on("focus",function(){
            $("[data-error='permanent_address']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='dob']").on("focus",function(){
            $("[data-error='dob']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='joining_date']").on("focus",function(){
            $("[data-error='joining_date']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='marital_status']").on("focus",function(){
            $("[data-error='marital_status']").html("");
            $(this).removeClass("is-invalid");
        });

    });
</script>
@endsection