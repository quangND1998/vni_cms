@extends('landingpage.layout2')
@section('content')
    @foreach ($sections as $key => $section)
        {{--  @if($key ==3)
            @include('template.outstanding-project')
        @elseif ($key ==4)
            @include('template.update-information')
        @else  --}}
           @include($section->theme->link_code)        
        {{--  @endif  --}}
       
    @endforeach
@endsection