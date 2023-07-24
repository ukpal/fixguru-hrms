<ul class="breadcrumb mb-0">
    {{-- <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('holidays.index')}}">Holidays</a></li>
    <li class="breadcrumb-item active">Add</li> --}}
{{-- </ul> --}}

@for($i = 1; $i <= count(Request::segments()); $i++)
    @if($i < count(Request::segments()) & $i > 0)      
        <li class="breadcrumb-item"><a href="{{url(Request::segment($i))}}">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
    @else 
        <li class="breadcrumb-item active">{{ucwords(str_replace('-',' ',Request::segment($i)))}}</li>       
    @endif
@endfor

</ul>