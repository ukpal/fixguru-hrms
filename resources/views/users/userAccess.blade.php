@extends('layout')

@section('style')
@parent
{{-- <link rel="stylesheet" href="{{asset('assets/css/dataTables.min.css')}}"> --}}
@endsection

@section('content')
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Users Access Limit</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('users.all')}}">Users</a></li>
                        <li class="breadcrumb-item active"><a>Set Access</a></li>
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
        @php
            $user=App\Models\Employee::find(Request::segment(3));
        @endphp

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title">Set Access Limit for: {{$user->fname.' '.$user->lname}}</h6>
                        <ul class="header-dropdown">
                            <li><a type="button" href="{{route('users.all')}}" class="btn btn-outline-danger">Back</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="employee_List" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>                                  
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Users</td>
                                    <td>
                                        <input id="a1" type="checkbox" name="view users" value="{{$user->hasPermissionTo('view users') ? 1 : 0}}" {{$user->hasPermissionTo('view users') ? 'checked' : ''}}>
                                            <label for="a1"></label>
                                    </td>
                                    <td>
                                        <input id="b1" type="checkbox" name="edit users" value="{{$user->hasPermissionTo('edit users') ? 1 : 0}}" {{$user->hasPermissionTo('edit users') ? 'checked' : ''}}>
                                            <label for="b1"></label>
                                    </td>
                                </tr>                      
                                <tr>
                                    <td>2</td>
                                    <td>Employees</td>
                                    <td>
                                        <input id="a1" type="checkbox" name="view employees" value="{{$user->hasPermissionTo('view employees') ? 1 : 0}}" {{$user->hasPermissionTo('view employees') ? 'checked' : ''}}>
                                            <label for="a1"></label>
                                    </td>
                                    <td>
                                        <input id="b1" type="checkbox" name="edit employees" value="{{$user->hasPermissionTo('edit employees') ? 1 : 0}}" {{$user->hasPermissionTo('edit employees') ? 'checked' : ''}}>
                                            <label for="b1"></label>
                                    </td>
                                </tr>                      
                                <tr>
                                    <td>3</td>
                                    <td>Departments</td>
                                    <td>
                                        <input id="a1" type="checkbox" name="view departments" value="{{$user->hasPermissionTo('view departments') ? 1 : 0}}" {{$user->hasPermissionTo('view departments') ? 'checked' : ''}}>
                                            <label for="a1"></label>
                                    </td>
                                    <td>
                                        <input id="b1" type="checkbox" name="edit departments" value="{{$user->hasPermissionTo('edit departments') ? 1 : 0}}" {{$user->hasPermissionTo('edit departments') ? 'checked' : ''}}>
                                            <label for="b1"></label>
                                    </td>
                                </tr>                      
                                <tr>
                                    <td>4</td>
                                    <td>Holidays</td>
                                    <td>
                                        <input id="a1" type="checkbox" name="view holidays" value="{{$user->hasPermissionTo('view holidays') ? 1 : 0}}" {{$user->hasPermissionTo('view holidays') ? 'checked' : ''}}>
                                            <label for="a1"></label>
                                    </td>
                                    <td>
                                        <input id="b1" type="checkbox" name="edit holidays" value="{{$user->hasPermissionTo('edit holidays') ? 1 : 0}}" {{$user->hasPermissionTo('edit holidays') ? 'checked' : ''}}>
                                            <label for="b1"></label>
                                    </td>
                                </tr>                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  

    </div>
</div>

@endsection

@section('script')
@parent
{{-- <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script> --}}
{{-- <script src="{{asset('assets/bundles/sweetalert2.bundle.js')}}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type="checkbox"]').click(function () {
            const name = $(this).attr('name');
            var value = $(this).val();
            value = (value == 0 || value == '') ? 1 : 0;
            var user_id = "{{ Request::segment(3) }}";
            const path = "{{url('/users/setAccess/')}}";
            $(this).val(value);
            $.ajax({
                type: "POST",
                url: path, // Route
                data: {
                    checkbox_val: value,
                    check_name: name,
                    user_id: user_id
                },
            })
                .done(function (resp) {
                    swal({
                        title: "Permission Updated",
                        icon: "success",
                    });
                });
        });
    });
</script>
@endsection