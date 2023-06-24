@extends('landingpage.layout2')
@section('content')
    <div class="page_product1">ui/ux
        
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12 centerab">
                        <h1 class="title-visualization title">{{__($content->title)}}</h1>
                    </div>
                    <hr class="line">
                    <div class="content_visuali">
                        <span>
                            {!! __($content->description) !!}
                           </span>
                    </div>
                </div>

            </div>
            <div class="row" style="margin-top:3rem;padding-bottom:5rem">
                <div class=" page_product_video">
                    <div class="col-lg-12">
                        <iframe style="margin-bottom: -5px;" class="url_world_in_3d" width="100%" height="800" src="{{$content->link}}" allow="vr" frameborder="0" allowfullscreen=""></iframe>

                    </div>
                </div>
            </div>
        </div>
@endsection
