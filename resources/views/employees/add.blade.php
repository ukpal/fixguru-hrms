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
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Employee</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('employees.all')}}">Employees</a></li>
                        <li class="breadcrumb-item active"><a>Create</a></li>
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
                        <h6 class="card-title">Add Employee</h6>
                        <ul class="header-dropdown">
                            <li><a type="button" href="{{route('employees.all')}}" class="btn btn-outline-danger">Back</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" id="basic-form" action="{{route('employees.store')}}" method="post" novalidate="">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="first_name">First Name <small class="text-danger">*</small></label>
                                <input type="text" maxlength="80" id="first_name" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                                @error('first_name')
                                <small class="text-danger" data-error='first_name'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="last_name">Last Name <small class="text-danger">*</small></label>
                                <input type="text" maxlength="80" id="last_name" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
                                @error('last_name')
                                <small class="text-danger" data-error='last_name'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="gender">Gender <small class="text-danger">*</small></label>
                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">select option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger" data-error='gender'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="phone">Phone Number <small class="text-danger">*</small><small> (In case of multiple number, seperate them with comma)</small></label>
                                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                <small class="text-danger" data-error='phone'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="father_name">Father Name <small class="text-danger">*</small></label>
                                <input type="text" maxlength="80" id="father_name" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}">
                                @error('father_name')
                                <small class="text-danger" data-error='father_name'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="permanent_address">Permanent Address <small class="text-danger">*</small></label>
                                <textarea name="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address" cols="30" rows="3">{{ old('permanent_address') }}</textarea>
                                @error('permanent_address')
                                    <small class="text-danger" data-error='permanent_address'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="temporary_address">Temporary Address</label>
                                <textarea name="temporary_address" class="form-control @error('temporary_address') is-invalid @enderror" id="temporary_address" cols="30" rows="3">{{ old('temporary_address') }}</textarea>
                                @error('temporary_address')
                                    <small class="text-danger" data-error='temporary_address'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="dob">Date of Birth <small class="text-danger">*</small></label>
                                <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                @error('dob')
                                <small class="text-danger" data-error='dob'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="joining_date">Joining Date <small class="text-danger">*</small></label>
                                <input type="date" id="joining_date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date') }}">
                                @error('joining_date')
                                <small class="text-danger" data-error='joining_date'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="confirmation_date">Confirmation Date </label>
                                <input type="date" id="confirmation_date" name="confirmation_date" class="form-control @error('confirmation_date') is-invalid @enderror" value="{{ old('confirmation_date') }}">
                                @error('confirmation_date')
                                <small class="text-danger" data-error='confirmation_date'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="marital_status">Marital Status <small class="text-danger">*</small></label>
                                <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                                    <option value="">Select Option</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                                @error('marital_status')
                                    <small class="text-danger" data-error='marital_status'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="departments">Department</label>
                                <select class="form-select select2  @error('departments') is-invalid @enderror" id="departments" name="departments[]" multiple="multiple">
                                    {{-- <option value=''>Select Departments</option> --}}
                                    @foreach ($depts as $item)
                                    <option value="{{$item->id}}">{{$item->dept_name}}</option>
                                    @endforeach
                                </select>
                                @error('departments')
                                    <small class="text-danger" data-error='departments'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="designations">Designation</label>
                                <select class="form-select select2  @error('designations') is-invalid @enderror" id="designations" name="designations[]" multiple="multiple" value="{{ old('designations') }}">
                                    {{-- <option value=''>Select Designations</option> --}}
                                    @foreach ($desig as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('designations')
                                    <small class="text-danger" data-error='designations'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="skills">Skills</label>
                                <select class="form-select select2  @error('skills') is-invalid @enderror" id="skills" name="skills[]" multiple="multiple" value="{{ old('skills') }}">
                                    {{-- <option value=''>Select Designations</option> --}}
                                    @foreach ($skill as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('skills')
                                    <small class="text-danger" data-error='skills'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="employment_type">Employment Type</label>
                                <select class="form-select @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type" value="{{ old('employment_type') }}">
                                    <option value=''>Select Employment Type</option>
                                    @foreach ($emp_types as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('employment_type')
                                    <small class="text-danger" data-error='employment_type'>{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- <div class="col-12">
                                <label class="form-label" for="department">Department</label>
                                <select class="form-select @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}">
                                    <option value=''>Select Departments</option>
                                    @foreach ($departments as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <small class="text-danger" data-error='department'>{{ $message }}</small>
                                @enderror
                            </div> --}}

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
            $(this).attr("min", $("[name='dob']").val());
            $("[data-error='joining_date']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='confirmation_date']").on("focus",function(){
            $(this).attr("min", $("[name='joining_date']").val());
            $("[data-error='confirmation_date']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='marital_status']").on("focus",function(){
            $("[data-error='marital_status']").html("");
            $(this).removeClass("is-invalid");
        });

    });
</script>
@endsection