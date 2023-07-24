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
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-primary btn-sm btn-toggle-fullwidth"><i class="fa fa-angle-double-left fs-4"></i></a> Employee</h2>
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
                        <div class="profile-image mb-1"><img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-512.png" class="rounded-circle" alt="profile" width="150"> </div>
                        <div>
                            <span>{{count($emp->empType)>0 ? '('.$emp->empType[0]->name.')' : ''}}</span> <br>
                            <h4 class=""><strong>{{$emp->fname}}</strong> {{$emp->lname}}, <small>{{$emp->gender}}</small></h4>
                            @foreach ($emp->designations as $item)
                            <span>{{$item->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="card-title">Info</h6>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Address: </small>
                        <p>{{$emp->permanent_address}}</p>
                        <hr>
                        <small class="text-muted">Joining Date: </small>
                        <p>{{$emp->joining_date}}</p>
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
                                <a class="nav-link {{!Session::get('tab') ? 'active':''}}" id="personal-details-tab" data-bs-toggle="tab" href="#personal-details" role="tab">Personal Details</a>
                                </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{Session::get('tab')=='emergency-contact' ? 'active':''}}" id="emergency-contact-tab" data-bs-toggle="tab" href="#emergency-contact" role="tab">Emergency Contact</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{Session::get('tab')=='background-verification' ? 'active':''}}" id="background-verification-tab" data-bs-toggle="tab" href="#background-verification" role="tab">Background Verification</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{Session::get('tab')=='employee-documents' ? 'active':''}}" id="employee-documents-tab" data-bs-toggle="tab" href="#employee-documents" role="tab">Employee Documents</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content p-0 " id="myTabContent">
                    <div class="tab-pane fade {{!Session::get('tab') ? 'show active':''}}" id="personal-details">
                         <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Personal Details</h6>
                                <form action="{{url('employees/update/'.$emp->id.'/personal-details')}}" id="personal-details-form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone Number <small class="text-danger">*</small><small>(In case of multiple number, seperate them with comma)</small></label>
                                            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$emp->phone}}">
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
                                        @if (count($emp->TemporaryAddresses))
                                        @if (count($emp->TemporaryAddresses)>1)
                                        <div class="mb-3">
                                            <label class="form-label" for="old-temporary_address">Old Temporary Address</label>
                                            <textarea class="form-control" disabled id="old-temporary_address" cols="30" rows="3">{{ $emp->TemporaryAddresses[count($emp->TemporaryAddresses)-2]->address }}</textarea>
                                        </div>
                                        @endif                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="prev-temporary_address">Previous Temporary Address</label>
                                            <textarea class="form-control" disabled id="prev-temporary_address" cols="30" rows="3">{{ $emp->TemporaryAddresses[count($emp->TemporaryAddresses)-1]->address }}</textarea>
                                        </div>
                                        @endif
                                        
                                        <div class="mb-1 d-none" id="temp-addr-input-box">
                                            <label class="form-label" for="temporary_address">Temporary Address</label>
                                            <textarea name="temporary_address" class="form-control @error('temporary_address') is-invalid @enderror" id="temporary_address" cols="30" rows="3">{{ $emp->temporary_address }}</textarea>
                                            @error('temporary_address')
                                                <small class="text-danger" data-error='temporary_address'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-4 text-end">                 
                                            {{-- <button class="btn btn-danger rounded-circle remove-current"><i class="fa fa-minus"></i></button> --}}
                                            <a href="javascript:void(0);" class="add-temp-addr float-end">Add New Temporary Address</a>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="confirmation_date">Confirmation Date </label>
                                            <input type="date" id="confirmation_date" name="confirmation_date" class="form-control @error('confirmation_date') is-invalid @enderror" value="{{ $emp->confirmation_date }}">
                                            @error('confirmation_date')
                                            <small class="text-danger" data-error='confirmation_date'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="marital_status">Marital Status <small class="text-danger">*</small></label>
                                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                                                <option value="Single" {{$emp->marital_status=='Single' ? 'selected' : ''}}>Single</option>
                                                <option value="Married" {{$emp->marital_status=='Married' ? 'selected' : ''}}>Married</option>
                                                <option value="Divorced" {{$emp->marital_status=='Divorced' ? 'selected' : ''}}>Divorced</option>
                                            </select>
                                            @error('marital_status')
                                                <small class="text-danger" data-error='marital_status'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        @php
                                        $emp_dept_arr=[];
                                        foreach ($emp->departments as $item) {
                                            $emp_dept_arr[]=$item->id;
                                        }
                                        @endphp
                                        <div class="mb-3">
                                            <label class="form-label" for="departments">Department</label>
                                            <select class="form-select select2  @error('departments') is-invalid @enderror" id="departments" name="departments[]" multiple="multiple">
                                                {{-- <option value=''>Select Departments</option> --}}
                                                @foreach ($depts as $item)
                                                <option value="{{$item->id}}" {{in_array($item->id,$emp_dept_arr)?'selected':''}}>{{$item->dept_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('departments')
                                                <small class="text-danger" data-error='departments'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        @php
                                        $emp_desg_arr=[];
                                        foreach ($emp->designations as $item) {
                                            $emp_desg_arr[]=$item->id;
                                        }
                                        @endphp
                                        <div class="mb-3">
                                            <label class="form-label" for="designations">Designation</label>
                                            <select class="form-select select2  @error('designations') is-invalid @enderror" id="designations" name="designations[]" multiple="multiple" value="{{ old('designations') }}">
                                                {{-- <option value=''>Select Designations</option> --}}
                                                @foreach ($desig as $item)
                                                <option value="{{$item->id}}" {{in_array($item->id,$emp_desg_arr)?'selected':''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('designations')
                                                <small class="text-danger" data-error='designations'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        @php
                                        $emp_skills_arr=[];
                                        foreach ($emp->skills as $item) {
                                            $emp_skills_arr[]=$item->id;
                                        }
                                        @endphp
                                        <div class="mb-3">
                                            <label class="form-label" for="skills">Skills</label>
                                            <select class="form-select select2  @error('skills') is-invalid @enderror" id="skills" name="skills[]" multiple="multiple" value="{{ old('skills') }}">
                                                {{-- <option value=''>Select Designations</option> --}}
                                                @foreach ($skill as $item)
                                                <option value="{{$item->id}}" {{in_array($item->id,$emp_skills_arr)?'selected':''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('skills')
                                                <small class="text-danger" data-error='skills'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="employment_type">Employment Type</label>
                                            <select class="form-select  @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type">
                                                <option value=''>Select Employment Type</option>
                                                @foreach ($emp_types as $item)
                                                <option value="{{$item->id}}" {{count($emp->empType)>0 ? ($item->id==$emp->empType[0]->id ? 'selected' : '') : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('employment_type')
                                                <small class="text-danger" data-error='employment_type'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{Session::get('tab')=='emergency-contact' ? 'show active':''}}" id="emergency-contact">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Emergency Contact
                                    <button class="btn btn-primary float-end" id="add-emergency-contact">Add New Contact</button>
                                </h6>
                                <form action="{{url('employees/update/'.$emp->id.'/emergency-contact')}}" id="emergency-contact-form" method="POST" class="{{Session::get('tab')=='emergency-contact' ? '':'d-none'}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name <small class="text-danger">*</small></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" maxlength="80" id="name" placeholder="emergency contact person's name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger" data-error='name'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone <small class="text-danger">*</small></label>
                                            <input type="tel" name="phone"  class="form-control @error('phone') is-invalid @enderror" maxlength="10" id="phone" placeholder="emergency contact person's phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <small class="text-danger" data-error='phone'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="address">Address <small class="text-danger">*</small></label>
                                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="emergency contact person's address" value="{{ old('address') }}">
                                            @error('address')
                                                <small class="text-danger" data-error='address'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="relation">Relation <small class="text-danger">*</small></label>
                                            <input type="text" name="relation"  class="form-control @error('relation') is-invalid @enderror" maxlength="50" id="relation" placeholder="relation with emergency contact person" value="{{ old('relation') }}">
                                            @error('relation')
                                                <small class="text-danger" data-error='relation'>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="blood_group">Blood Group </label>
                                            <input type="text" name="blood_group" class="form-control" id="blood_group" maxlength="3" placeholder="enter employee blood group" >
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table id="emergency-contact" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>                                  
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($emp->emergencyContact as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><h6 class="mb-0"><a href="javascript:void(0);" class="show-emergency-contact" data-attr={{$item->id}}
                                                        title="details" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$item->name}}</a></h6>
                                                    </td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>{{ date("Y-m-d",strtotime($item->created_at))}}</td>
                                                </tr>
                                                @endforeach 
                                                @if(count($emp->emergencyContact)==0)
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
                    <div class="tab-pane fade {{Session::get('tab')=='background-verification' ? 'show active':''}}" id="background-verification">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Background Verification
                                    <button class="btn btn-primary float-end" id="add-background-verification">New Verification</button>
                                </h6>
                                <form action="{{url('employees/update/'.$emp->id.'/background-verification')}}" id="background-verification-form" class="{{Session::get('tab')=='background-verification' ? '':'d-none'}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="verification_type">Verification Type <small class="text-danger">*</small></label>
                                                <select name="verification_type" name="verification_type" id="verification_type" class="form-control @error('verification_type') is-invalid @enderror">
                                                    <option value="">select option</option>
                                                    <option value="PCC" >PCC</option>
                                                    <option value="Sarpanch">Sarpanch</option>
                                                    <option value="Aadhar">Aadhar</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                @error('verification_type')
                                                    <small class="text-danger" data-error='verification_type'>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3" id="vf-div">
                                                <label class="form-label" for="verification_proof">Verification Proof <small class="text-danger">*</small></label>
                                                <input class="form-control @error('verification_proof') is-invalid @enderror" type="file" id="verification_proof" name="verification_proof">
                                                @error('verification_proof')
                                                    <small class="text-danger" data-error='verification_proof'>{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="background_verification_remarks">Remarks <small class="text-danger">*</small></label>
                                                <textarea name="background_verification_remarks" class="form-control @error('background_verification_remarks') is-invalid @enderror" id="background_verification_remarks" cols="30" rows="3">{{ old('background_verification_remarks') }}</textarea>
                                                @error('background_verification_remarks')
                                                    <small class="text-danger" data-error='background_verification_remarks'>{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                    <button type="button" class="btn btn-secondary cancel-btn" >Cancel</button>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table id="background-verification-tbl" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>                                  
                                                    <th>#</th>
                                                    <th>Type</th>
                                                    <th>Created</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($emp->backgroundVerification as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><h6 class="mb-0"><a href="javascript:void(0);" class="show-verification-doc" data-attr={{$item->id}}
                                                        title="details" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$item->type}}</a></h6></td>
                                                    <td>{{ date("Y-m-d",strtotime($item->created_at))}}</td>
                                                    <td>{{$item->remarks}}</td>
                                                </tr>
                                                @endforeach 
                                                @if(count($emp->backgroundVerification)==0)
                                                <tr>
                                                    <td colspan="3" style="text-align: center">No data found</td>
                                                </tr>
                                                @endif                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{Session::get('tab')=='employee-documents' ? 'show active':''}}" id="employee-documents">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Employee Documents
                                    <button class="btn btn-primary float-end" id="employee-documents">Add New Document</button>
                                </h6>
                                <form action="{{url('employees/update/'.$emp->id.'/employee-documents')}}" id="employee-documents-form" class="{{Session::get('tab')=='employee-documents' ? '':'d-none'}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 ed-div">
                                            <div class="border-bottom border-primary border-3 mb-3 ed-inner-div">
                                                <div class="mb-3">
                                                    <label class="form-label" for="document_name">Name of Document <small class="text-danger">*</small></label>
                                                    <input class="form-control @error('document_name') is-invalid @enderror" type="text" id="document_name" name="document_name" value="{{ old('document_name') }}">
                                                    @error('document_name')
                                                        <small class="text-danger" data-error='document_name'>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="upload_document">Upload Document <small class="text-danger">*</small></label>
                                                    <input class="form-control @error('upload_document') is-invalid @enderror" type="file" id="upload_document" name="upload_document">
                                                    @error('upload_document')
                                                        <small class="text-danger" data-error='upload_document'>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="upload_document_remarks">Remarks <small class="text-danger">*</small></label>
                                                    <textarea name="upload_document_remarks" class="form-control  @error('upload_document') is-invalid @enderror" id="upload_document_remarks" cols="30" rows="3">{{ old('upload_document_remarks') }}</textarea>
                                                    @error('upload_document_remarks')
                                                        <small class="text-danger" data-error='upload_document_remarks'>{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                {{-- <div class="mb-3 text-end">
                                                    
                                                    <button class="btn btn-danger rounded-circle remove-current"><i class="fa fa-minus"></i></button>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mb-3">
                                                <button type="submit" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                                                <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                                                {{-- <button class="btn btn-primary add-more float-end">Add More</button> --}}
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <table id="employee-documents-tbl" class="table table-hover">
                                            <thead class="thead-dark">
                                                <tr>                                  
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Created</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>                                          
                                                @foreach ($emp->empDocuments as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><h6 class="mb-0"><a href="javascript:void(0);" class="show-employee-doc" data-attr={{$item->id}}
                                                        title="details" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$item->name}}</a></h6></td>
                                                    <td>{{ date("Y-m-d",strtotime($item->created_at))}}</td>
                                                    <td>{{$item->remarks}}</td>
                                                </tr>
                                                @endforeach 
                                                @if(count($emp->empDocuments)==0)
                                                <tr>
                                                    <td colspan="3" style="text-align: center">No data found</td>
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
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
{{-- <script src="{{asset('assets/bundles/dataTables.bundle.js')}}"></script> --}}

<script type="text/javascript">
    $(function () {
        $('button#add-emergency-contact').on('click',function(){
            $('#emergency-contact-form').removeClass('d-none');
        });
        $('button#add-background-verification').on('click',function(){
            $('#background-verification-form').removeClass('d-none');
        });
        $('button#employee-documents').on('click',function(){
            $('#employee-documents-form').removeClass('d-none');
        });
        $('button.cancel-btn').on('click',function(){
            $(this).parents('form').addClass('d-none');
        });
        $("#departments").select2({
            placeholder: 'select departments',
        });
        $("#designations").select2({
            placeholder: 'select designations',
        });
        $("#skills").select2({
            placeholder: 'select skills',
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
        $("[name='marital_status']").on("focus",function(){
            $("[data-error='marital_status']").html("");
            $(this).removeClass("is-invalid");
        });
        // $("[name='verification_type']").on("change",function(){
        //     if($(this).val()){
        //         $('#vf-div').removeClass('d-none');
        //         $('#verification_proof').attr('required',true);
        //     }
        // });
        $("[name='name']").on("focus",function(){
            $("[data-error='name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='phone']").on("focus",function(){
            $("[data-error='phone']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='address']").on("focus",function(){
            $("[data-error='address']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='relation']").on("focus",function(){
            $("[data-error='relation']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='blood_group']").on("focus",function(){
            $("[data-error='blood_group']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='verification_type']").on("focus",function(){
            $("[data-error='verification_type']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='verification_proof']").on("focus",function(){
            $("[data-error='verification_proof']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='background_verification_remarks']").on("focus",function(){
            $("[data-error='background_verification_remarks']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='document_name']").on("focus",function(){
            $("[data-error='document_name']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='upload_document']").on("focus",function(){
            $("[data-error='upload_document']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='upload_document_remarks']").on("focus",function(){
            $("[data-error='upload_document_remarks']").html("");
            $(this).removeClass("is-invalid");
        });
        // $('.add-more').on('click',function(){
        //     var a=$('.ed-div').first().html();
        //     $(this).closest('.col-lg-12').before(a);
        //     $(".remove-current").show();
        //     $(".remove-current:first").hide();
        // });
        // $(".remove-current:first").hide();
        // $(document).on('click','.remove-current',function(){
        //     $(this).closest('.ed-inner-div').remove();
        // });
        $(".add-temp-addr").on('click',function(){
            $("div#temp-addr-input-box").toggleClass('d-none');
        });
        var loader="<div class='w-100 text-center'><img src='https://media.tenor.com/-n8JvVIqBXkAAAAM/dddd.gif' class='mx-auto' width='50'></div>";
        $('.show-employee-doc').on('click',function(){
            $('.modal-body').html("");
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'employee-document';
            $('.modal-title').text('Employee Document');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                    //   console.log(data);
                      
                    $('.modal-body').html(data);
                },
                error: function(data) {
                    console.log('error',data)
                }
            });
        });
        $('.show-verification-doc').on('click',function(){
            $('.modal-body').html("");
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'background-verification';
            $('.modal-title').text('Background Verification');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                    //   console.log(data);
                      
                    $('.modal-body').html(data);
                },
                error: function(data) {
                    console.log('error',data)
                }
            });
        });
        $('.show-emergency-contact').on('click',function(){
            $('.modal-body').html("");
            var id=$(this).attr('data-attr');
            var url="{{url('employees/show')}}" + '/' + id + '/' + 'emergency-contact';
            $('.modal-title').text('Emergency Contact');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                beforeSend:function(){
                    $('.modal-body').html(loader);
                },
                success: function(data) {
                    //   console.log(data);
                      
                    $('.modal-body').html(data);
                },
                error: function(data) {
                    console.log('error',data)
                }
            });
        });
    });
</script>
@endsection