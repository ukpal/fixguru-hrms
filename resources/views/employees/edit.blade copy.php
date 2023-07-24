@extends('layout')

@section('style')
@parent
<style>
    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #fff;
        background-color: var(--primary-color);
    }
</style>
@endsection

@section('content')
<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Employee</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('employees.all')}}">Employees</a></li>
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

        <div class="row g-3">
            <div class="col-lg-4 col-md-12">
                <div class="card mb-3 profile-header">
                    <div class="card-body text-center">
                        <div class="profile-image mb-3"><img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-512.png" class="rounded-circle" alt="profile" width="150"> </div>
                        <div>
                            <h4 class=""><strong>{{$emp->fname}}</strong> {{$emp->lname}}</h4>
                            <span>{{$emp->permanent_address}}</span>
                        </div>
                        <!--<div class="mt-3">-->
                        <!--    <button class="btn btn-primary">Follow</button>-->
                        <!--    <button class="btn btn-outline-secondary">Message</button>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="card-title">Info</h6>
                        <!--<ul class="header-dropdown">-->
                        <!--    <li class="dropdown">-->
                        <!--        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>-->
                        <!--        <ul class="dropdown-menu dropdown-menu-end">-->
                        <!--            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>-->
                        <!--            <li><a class="dropdown-item" href="javascript:void(0);">Another Action</a></li>-->
                        <!--            <li><a class="dropdown-item" href="javascript:void(0);">Something else</a></li>-->
                        <!--        </ul>-->
                        <!--    </li>-->
                        <!--</ul>-->
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Address: </small>
                        <p>no data found</p>
                        <hr>
                        <small class="text-muted">Email address: </small>
                        <p>no data found</p>
                        <hr>
                        <small class="text-muted">Mobile: </small>
                        <p>{{$emp->phone}}</p>
                        <hr>
                        <small class="text-muted">Birth Date: </small>
                        <p>{{$emp->dob}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="personal-details-tab" data-bs-toggle="tab" href="#personal-details" role="tab">Personal Details</a>
                                </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="emergency-contact-tab" data-bs-toggle="tab" href="#emergency-contact" role="tab">Emergency Contact</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="background-verification-tab" data-bs-toggle="tab" href="#background-verification" role="tab">Background Verification</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="employee-documents-tab" data-bs-toggle="tab" href="#employee-documents" role="tab">Employee Documents</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content p-0 " id="myTabContent">
                    <div class="tab-pane fade show active" id="personal-details">
                         <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Personal Details</h6>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="first_name">First Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" value="{{$emp->fname}}" placeholder="First Name" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">Last Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" value="{{$emp->lname}}" placeholder="Last Name" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="gender">Gender <small class="text-danger">*</small></label>
                                            <select name="gender" id="gender" class="form-control" disabled>
                                                <option value="">select option</option>
                                                <option value="Male" {{$emp->gender=='Male' ? 'selected':''}}>Male</option>
                                                <option value="Female" {{$emp->gender=='Female' ? 'selected':''}}>Female</option>
                                                <option value="Other" {{$emp->gender=='Other' ? 'selected':''}}>Other</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone Number <small class="text-danger">*</small></label>
                                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$emp->lname}}">
                                            <small  class="text-danger">In case of multiple number, seperate them with comma</small> <br>
                                            @error('phone')
                                            <small class="text-danger" data-error='phone'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="father_name">Father Name <small class="text-danger">*</small></label>
                                            <input type="text" id="father_name" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ $emp->father_name }}">
                                            @error('father_name')
                                            <small class="text-danger" data-error='father_name'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="permanent_address">Permanent Address <small class="text-danger">*</small></label>
                                            <textarea name="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address" cols="30" rows="3">{{ old('permanent_address') }}</textarea>
                                            @error('permanent_address')
                                                <small class="text-danger" data-error='permanent_address'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="temporary_address">Temporary Address</label>
                                            <textarea name="temporary_address" class="form-control @error('temporary_address') is-invalid @enderror" id="temporary_address" cols="30" rows="3">{{ old('temporary_address') }}</textarea>
                                            <small>In case of multiple address, seperate them with pipe (|)</small>
                                            @error('temporary_address')
                                                <small class="text-danger" data-error='temporary_address'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="dob">Date of Birth <small class="text-danger">*</small></label>
                                            <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                            @error('dob')
                                            <small class="text-danger" data-error='dob'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="joining_date">Joining Date <small class="text-danger">*</small></label>
                                            <input type="date" id="joining_date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date') }}">
                                            @error('joining_date')
                                            <small class="text-danger" data-error='joining_date'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="confirmation_date">Confirmation Date </label>
                                            <input type="date" id="confirmation_date" name="confirmation_date" class="form-control @error('confirmation_date') is-invalid @enderror" value="{{ old('confirmation_date') }}">
                                            @error('confirmation_date')
                                            <small class="text-danger" data-error='confirmation_date'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="marital_status">Marital Status <small class="text-danger">*</small></label>
                                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                            @error('marital_status')
                                                <small class="text-danger" data-error='marital_status'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
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
                                        <div class="mb-3">
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
                                        <div class="mb-3">
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
                                        <div class="mb-3">
                                            <label class="form-label" for="employment_type">Employment Type</label>
                                            <select class="form-select select2  @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type[]" multiple="multiple" value="{{ old('employment_type') }}">
                                                {{-- <option value=''>Select Employment Type</option> --}}
                                                @foreach ($emp_types as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('employment_type')
                                                <small class="text-danger" data-error='employment_type'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="emergency-contact">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Emergency Contact</h6>
                                <form action="{{url('employees/update/'.$emp->id.'/emergency-contact')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name </label>
                                            <input type="text" name="name" value="{{$emp->emergency_contact->name ?? ''}}" class="form-control" id="name" placeholder="emergency contact person's name" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone </label>
                                            <input type="tel" name="phone" value="{{$emp->emergency_contact->phone ?? ''}}" class="form-control" id="phone" placeholder="emergency contact person's phone" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address </label>
                                            <input type="text" name="address" value="{{$emp->emergency_contact->address ?? ''}}" class="form-control" id="address" placeholder="emergency contact person's address" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="relation">Relation </label>
                                            <input type="text" name="relation" value="{{$emp->emergency_contact->relation ?? ''}}" class="form-control" id="relation" placeholder="relation with emergency contact person" >
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="blood_group">Blood Group </label>
                                            <input type="text" name="blood_group" value="{{$emp->emergency_contact->blood_group ?? ''}}" class="form-control" id="blood_group" placeholder="enter your blood group" >
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                <button type="button" class="btn btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="background-verification">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Background Verification</h6>
                                <form action="{{url('employees/update/'.$emp->id.'/background-verification')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="verification_type">Verification Type </label>
                                                <select name="verification_type" name="verification_type" id="verification_type" class="form-control">
                                                    <option value="">select option</option>
                                                    <option value="PCC" >PCC</option>
                                                    <option value="Sarpanch">Sarpanch</option>
                                                    <option value="Aadhar">Aadhar</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 d-none" id="vf-div">
                                                <label class="form-label" for="verification_proof">Verification Proof </label>
                                                <input class="form-control" type="file" id="verification_proof" name="verification_proof">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="background_verification_remarks">Remarks</label>
                                                <textarea name="background_verification_remarks" class="form-control @error('background_verification_remarks') is-invalid @enderror" id="background_verification_remarks" cols="30" rows="3">{{ old('background_verification_remarks') }}</textarea>
                                                @error('background_verification_remarks')
                                                    <small class="text-danger" data-error='background_verification_remarks'>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                    <button type="button" class="btn btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="employee-documents">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Employee Documents</h6>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 ed-div">
                                        <div class="border-bottom border-primary border-3 mb-3 ed-inner-div">
                                            <div class="mb-3">
                                                <label class="form-label" for="document_name">Name of Document</label>
                                                <input class="form-control" type="text" id="document_name" name="document_name">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="upload_document">Upload Document </label>
                                                <input class="form-control" type="file" id="upload_document" name="upload_document">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="upload_document_remarks">Remarks</label>
                                                <textarea name="upload_document_remarks" class="form-control" id="upload_document_remarks" cols="30" rows="3">{{ old('upload_document_remarks') }}</textarea>
                                            </div>
                                            <div class="mb-3 text-end">
                                                
                                                <button class="btn btn-danger rounded-circle remove-current"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 mb-3">
                                             <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                            <button type="button" class="btn btn-secondary">Cancel</button>
                                            <button class="btn btn-primary add-more float-end">Add More</button>
                                    </div>
                                </div>
                                
                                <!--<button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;-->
                                <!--<button type="button" class="btn btn-secondary">Cancel</button>-->
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
            $(this).numeric();
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
        $("[name='verification_type']").on("change",function(){
            if($(this).val()){
                $('#vf-div').removeClass('d-none');
                $('#verification_proof').attr('required',true);
            }
        });
        $("[name='blood_group']").on("focus",function(){
            $("[data-error='blood_group']").html("");
            $(this).removeClass("is-invalid");
        });
        $('.add-more').on('click',function(){
            var a=$('.ed-div').first().html();
            $(this).closest('.col-lg-12').before(a);
            $(".remove-current").show();
            $(".remove-current:first").hide();
        });
        $(".remove-current:first").hide();
        $(document).on('click','.remove-current',function(){
            $(this).closest('.ed-inner-div').remove();
        });
    });
</script>
@endsection