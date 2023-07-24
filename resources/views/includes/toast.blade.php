@if(session('success'))

<div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="display: block;">
        <button type="button" class="toast-close-button" role="button">×</button>
        <div class="toast-message">{{session('success')}}</div>
    </div>
</div>

@elseif(session('error'))

<div id="toast-container" class="toast-top-right">
    <div class="toast toast-danger" aria-live="polite" style="display: block;">
        <button type="button" class="toast-close-button" role="button">×</button>
        <div class="toast-message">{{session('error')}}</div>
    </div>
</div>

@endif

{{-- @section('scripts')
@parent


@endsection --}}
