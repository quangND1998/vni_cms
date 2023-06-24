@extends('landingpage.layout')
@section('content')
 
<div class="immersive-activities">
    <div class="container-fluid">
        @foreach ($page->sections as $key => $section)   
                @include($section->theme->link_code)
        @endforeach
    
    </div>      
</div>

@endsection
