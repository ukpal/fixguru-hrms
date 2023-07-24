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
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Department</h2>
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
                        <h6 class="card-title">Add Department</h6>
                        <ul class="header-dropdown">
                            <li><a type="button" href="{{route('departments.all')}}" class="btn btn-outline-danger">Back</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="basic-form" action="{{route('departments.store')}}" method="post" novalidate="">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="dept_name">Department Name <small class="text-danger">*</small></label>
                                <input type="text" maxlength="90"  name="dept_name" id="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ old('dept_name') }}">
                                @error('dept_name')
                                    <small class="text-danger" data-error='dept_name'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="desc">Description <small class="text-danger">*</small></label>
                                <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" cols="30" rows="10">{{ old('desc') }}</textarea>
                                @error('desc')
                                    <small class="text-danger" data-error='desc'>{{ $message }}</small>
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
        $("[name='dept_name']").on("focus",function(){
            // $(this).alpha();
            $("[data-error='dept_name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='desc']").on("focus",function(){
            $("[data-error='desc']").html("");
            $(this).removeClass("is-invalid");
        });
    });
</script>
@endsection