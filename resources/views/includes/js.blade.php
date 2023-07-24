<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
<script src="{{URL::asset('assets/bundles/libscripts.bundle.js')}}"></script>
{{-- <script src="{{URL::asset('assets/js/index.js')}}"></script> --}}
<script src="{{URL::asset('assets/bundles/toastr.bundle.js')}}"></script>
<script src="{{URL::asset('assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{URL::asset('assets/plugin/alphanum/jquery.alphanum.js')}}"></script>
<script src="{{URL::asset('assets/bundles/select2.bundle.js')}}"></script>

<script>
  $(document).ready(function(){
    setTimeout(function () {
      $('#toast-container').fadeOut();
    }, 4000);
  })
</script>

@yield('script')