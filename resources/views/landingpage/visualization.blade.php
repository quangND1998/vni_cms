@extends('landingpage.layout2')
@section('content')
<div id="page_1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 centerab">
                @if(count($visual->sections) >0)
                    <h1 class="title-visualization title wow fadeInLeft" >{{__($visual->sections[0]->title)}}</h1>
                @endif
            </div>
            <hr class="line">
            <div class="content_visuali">
                  @if(count($visual->sections) >0)
                    <span>{!!__($visual->sections[0]->description)!!}</span>
                 @endif
            </div>
        </div>
        @foreach ($visual->sections as $section )
               @include($section->theme->link_code)         
 
        @endforeach
    </div>
</div>

@endsection