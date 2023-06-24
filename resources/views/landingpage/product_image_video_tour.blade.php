@extends('landingpage.layout')
@section('content')
     @if(count($content->images) >0)
        <div class="page_product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 centerab">
                        <h1 class="title-visualization title">{{__($content->title)}}</h1>
                    </div>
                    <hr class="line">
                    <div class="content_visuali">
                         <span>{!! __($content->description) !!}</span>
                    </div>
                </div>
                <div class="row">
                    <div class=" page_item_3drenders" style="padding-bottom :5rem;margin-top:5rem">
                          @foreach($content->images as $image )
                            <div class="item-slide">
                                <div class="product">
                                    <a href="{{$image->image}}" data-fancybox="images" data-caption="{{ $image->name }}"><img src="{{$image->image}}" alt="">
                                        {{--  <ul class="list_iconProduct">
                                            <li class="item_iconProduct">
                                                <i class="fas fa-heart"></i>
                                                <span>1276</span>
                                            </li>
                                            <li class="item_iconProduct">
                                                <i class="fas fa-comment"></i>
                                                <span>1276</span>
                                            </li>
                                            <li class="item_iconProduct">
                                                <i class="fas fa-eye"></i>
                                                <span>1276</span>
                                            </li>
                                        </ul>  --}}
                                        <h4 class="title_product">{{$image->name}}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($content->video)
        <div class="page_product1">
            <h2>VIDEO {{__($content->title)}}</h2>
            <div class="row" style="margin-top:3rem;padding-bottom:5rem">
                <div class=" page_product_video">
                    <div class="col-lg-12" style="position: relative;width: 100%; height:100%; ">
                        {{--  <video autoplay="" muted="" loop="" id="myVideo">
                            <source src="../img/video.mp4" type="video/mp4">
                        </video>  --}}
                        {{-- <amp-youtube class="video_gl" autoplay loop width="1200" height="500" layout="responsive" data-videoid="{{$content->video}}"></amp-youtube> --}}
                        <iframe class="video_gl" src="https://www.youtube.com/embed/{{$content->video}}" width="80%" height="80%" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
          @endif
        @if($content->link)
        <div class="page_video">
            <h2>TOUR {{__($content->title)}}</h2>
            <div class="row" style="margin-top:3rem;padding-bottom:5rem">
                <div class=" page_product_video">
                    <div class="col-lg-12 background-tour">

                        <div class="bg">
                            <div id="load-iframe" data-iframe="{{$content->link}}">
                                <div class="btn-tour">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                      <iframe  class="url_world_in_3d show-iframe" width="100%" height="800" src="{{$content->link}}" allow="vr" frameborder="0" allowfullscreen=""></iframe>

                </div>
            </div>
        </div>
        @endif
        <style>
            .back_all{
                background-color: 
            }
            .video_gl{

            }
        </style>
@endsection
