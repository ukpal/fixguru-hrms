@extends('layout')

@section('style')
@parent
<link rel="stylesheet" href="{{asset('assets/css/dataTables.min.css')}}">
@endsection

@section('content')
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Users</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Users</li>
                        {{-- <li class="breadcrumb-item active"><a>Edit</a></li> --}}
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
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="card-title">User List</h6>
                        <ul class="header-dropdown">
                            <li>
                                <a href="{{route('users.create')}}" class="btn btn-sm btn-outline-primary">Add New</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="employee_List" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>                                  
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Employee ID</th>
                                    <th>User Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emps as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <h6 class="mb-0">{{$item->fname}} {{$item->lname}}</h6>
                                    </td>
                                    <td><span>{{$item->employee_id}}</span></td>
                                    <td>
                                        <span>{{$item->user_type=='SA' ? 'Super User' : ''}}</span>
                                        <span>{{$item->user_type=='HE' ? 'HE User' : ''}}</span>
                                    </td>
                                    <td>
                                        @if ($item->user_type=='HE')
                                        <a href="{{route('users.getAccess',$item->id)}}" class="btn btn-sm btn-outline-secondary"
                                            title="set access"><i class="fa fa-edit"></i></a>
                                        @endif 
                                        
                                    </td>
                                </tr>
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  

    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/sweetalert2.bundle.js')}}"></script>
<script>
    $(document).ready(function () {
        var loader="<div class='w-100 text-center'><img src='https://media.tenor.com/-n8JvVIqBXkAAAAM/dddd.gif' class='mx-auto' width='50'></div>";
        $('#employee_List').dataTable({
            'responsive': true,
            
            'aoColumnDefs': [
                {
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
                },
            ]
        });
        $('.show-departments').on('click',function(){
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'department';
            $('.modal-title').text('Departments');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                      var h='';
                      if(data.length==0){
                          h+='no data found';
                      }else{
                          $.each(data,function(index, value){
                             h+="<p>"+value.dept_name+"</p>";
                          })
                      }
                      
                    $('.modal-body').html(h);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        });
        $('.show-designations').on('click',function(){
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'designation';
            $('.modal-title').text('Designations');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                      var h='';
                      if(data.length==0){
                          h+='no data found';
                      }else{
                          $.each(data,function(index, value){
                             h+="<p>"+value.name+"</p>";
                          })
                      }
                      
                    $('.modal-body').html(h);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        });
        $('.show-phones').on('click',function(){
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'phone';
            $('.modal-title').text('Contact Numbers');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                    $('.modal-body').html("");
                    if(data.phone){
                        data=data.phone.split(",");
                        var h='';
                        if(data.length==0){
                          h+='no data found';
                      }else{
                          $.each(data,function(index, value){
                            h+="<p>"+value+"</p>";
                        })
                      }
                        
                        $('.modal-body').html(h);
                    }                  
                },
                error: function(data) {
                    console.log(data)
                }
            });
        });

        $('.del-btn').on('click',function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href=$(this).attr('attr-url');
                } else {
                    return false;
                }
            })
        });
    });
</script>
@endsection