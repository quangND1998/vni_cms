@extends('landingpage.layout2')
@section('content')
       <div class="page_product1">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12 centerab">
                        <h1 class="title-visualization title">{{__($content->title)}}</h1>
                    </div>
                    <hr class="line">
                    <div class="content_visuali">
                        {!! __($content->description)!!}
                    </div>
                </div>

            </div>
            <div class="row" style="margin-top:3rem;padding-bottom:5rem">
                <div class=" page_product_video">
                    <div class="col-lg-12" style="position: relative;width: 100%; ">
                        {{--  <video autoplay="" muted="" loop="" id="myVideo" controls="true">
                            <source src="https://www.youtube.com/watch?v={{$content->video}}" type="video/mp4">
                        </video>  --}}
                        <amp-youtube class="video_gl" autoplay loop width="1200" height="500" layout="responsive" data-videoid="{{$content->video}}"></amp-youtube>
                        <!-- <iframe width="100%" height="100%" style="position:absolute" src="https://www.youtube.com/embed/YneVYIuflCU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </div>
                </div>
            </div>
        </div>

@endsection
