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
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Holidays</h2>
                    @include('includes.breadcrumb')                   
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
                        <h6 class="card-title">Holidays</h6>
                        <ul class="header-dropdown">
                            <li><a href="{{route('holidays.create')}}" class="btn btn-outline-primary">Add New</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table id="holidays_list" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Holiday name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holidays as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{route('holidays.edit',$item->id)}}">{{date('F d', strtotime($item->date))}}</a></td>
                                    <td>{{date('l', strtotime($item->date))}}</td>
                                    <td>{{$item->festival->name}}</td>
                                    <td>
                                        <a type="button" attr-url="{{route('holidays.delete',$item->id)}}"
                                            class="btn btn-sm btn-outline-danger del-btn"
                                            title="Delete"><i
                                                class="fa fa-trash-o"></i></a>
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

@endsection

@section('script')
@parent
<script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script>

<script src="{{asset('assets/bundles/sweetalert2.bundle.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#holidays_list')
        .dataTable({
            'responsive': true,
            // columnDefs: [
            //     { targets: [-1, -3], }
            // ],
            'aoColumnDefs': [
                {
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                },
            ]
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