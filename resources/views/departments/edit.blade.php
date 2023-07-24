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
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('departments.all')}}">Department</a></li>
                        <li class="breadcrumb-item active"><a>Edit</a></li>
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
                        <h6 class="card-title">Edit Department</h6>
                        <ul class="header-dropdown">
                            <li><a type="button" href="{{route('departments.all')}}" class="btn btn-outline-danger">Back</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="basic-form" action="{{route('departments.update',$dept->id)}}" method="post" novalidate="">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="dept_name">Department Name <small class="text-danger">*</small></label>
                                <input type="text" maxlength="90" name="dept_name" id="dept_name" class="form-control @error('dept_name') is-invalid @enderror" value="{{ $dept->dept_name }}">
                                @error('dept_name')
                                    <small class="text-danger" data-error='dept_name'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="dept_head">Department Head</label>
                                {{-- <input type="text" id="dept_head" name="dept_head" class="form-control @error('dept_head') is-invalid @enderror" value="{{ $dept->dept_head }}"> --}}
                                <select class="form-select @error('dept_head') is-invalid @enderror" id="dept_head" name="dept_head" value="{{ old('dept_head') }}">
                                    <option value='' selected>Select Department Head</option>
                                    @foreach ($emps as $item)
                                    <option value="{{$item->id}}" {{$dept->emp_id==$item->id ? 'selected':''}}>{{$item->fname.' '.$item->lname}}</option>
                                    {{-- <option value="{{$item->id}}">{{$item->name}}</option> --}}
                                    @endforeach
                                </select>
                                @error('dept_head')
                                    <small class="text-danger" data-error='dept_head'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="desc">Description <small class="text-danger">*</small></label>
                                <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" id="desc" cols="30" rows="5">{{ $dept->description }}</textarea>
                                @error('desc')
                                    <small class="text-danger" data-error='desc'>{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Employees associated with this department</h6>
                                <table id="emergency-contact" class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>                                  
                                            <th>#</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emps as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><h6 class="mb-0"><a href="{{route('employees.edit',$item->id)}}">{{$item->fname}} {{$item->lname}}</a></h6>
                                            </td>
                                        </tr>
                                        @endforeach 
                                        @if(count($emps)==0)
                                        <tr>
                                            <td colspan="4" style="text-align: center">No data found</td>
                                        </tr>
                                        @endif                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        // $("[name='dept_head']").on("focus",function(){
        //     $(this).alpha();
        //     $("[data-error='dept_head']").html("");
        //     $(this).removeClass("is-invalid");
        // });
        $("[name='desc']").on("focus",function(){
            $("[data-error='desc']").html("");
            $(this).removeClass("is-invalid");
        });
    });
</script>
@endsection