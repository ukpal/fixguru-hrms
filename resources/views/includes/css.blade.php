<!-- MAIN CSS -->
<link rel="stylesheet" href="{{URL::asset('assets/css/select2.min.css')}}" />
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<link rel="stylesheet" href="{{URL::asset('assets/css/toastr.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/main.css')}}">

<style>
    .breadcrumb-item+.breadcrumb-item::before {
        content: '/';
    }
    .card, .top_counter .icon, .list-group-custom .list-group-item, .sidebar .nav-tabs .nav-link.active {
        border-color: #dadada;
    }
    .form-control, .select2-container .select2-selection {
        border-color: #d8d8d8 !important;
    }
    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }
    .btn-toggle-fullwidth {
        position: absolute;
        left: -16px;
        z-index: 111;
        top: 12px;
    }
</style>
@yield('style')