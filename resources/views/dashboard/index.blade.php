@extends('layout')

@section('content')
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item active">Dashboard</li>
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

        <div class="row g-2 clearfix row-deck">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card top_counter">
                    <div class="list-group list-group-custom list-group-flush">
                        <div class="list-group-item d-flex align-items-center py-3">
                            <div class="icon text-center me-3"><i class="fa fa-users"></i> </div>
                            <div class="content">
                                <div>Total Employee</div>
                                <h5 class="mb-0">{{$total_emp}}</h5>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3">
                            <div class="icon text-center me-3"><i class="fa fa-calendar-o"></i> </div>
                            <div class="content">
                                <div>Total Holidays</div>
                                <h5 class="mb-0">{{$total_holiday}}</h5>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center py-3">
                            <div class="icon text-center me-3"><i class="fa fa-university"></i> </div>
                            <div class="content">
                                <div>Total Departments</div>
                                <h5 class="mb-0">{{$total_dept}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection