<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>:: Fixguru HRMS ::</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('includes.css')
</head>

<body>

<div id="layout" >

    <!-- Page Loader -->
    @include('includes.loader')
    <!-- Overlay For Sidebars -->

    <div id="wrapper">

        <!-- top navbar -->
        @include('includes.navbar')

        <!-- Sidbar menu -->
        @include('includes.sidebar')

        @yield('content')
      
    </div>

</div>

@include('includes.js')
@include('includes.toast')
</body>

</html>