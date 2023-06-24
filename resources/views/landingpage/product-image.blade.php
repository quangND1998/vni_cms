@extends('landingpage.layout2')
@section('content')
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
                                    <a href="{{$image->image}}" data-fancybox="images" data-caption="Ngoại cảnh "><img src="{{$image->image}}" alt="">
                                        {{--  <ul class="list_iconProduct">
                                            <li class="item_iconProduct">
                                                <i class="fas fa-heart"></i>
                                                <span>1276</span>
                                            </li>
                                            <li class="item_iconProduct">
                                                <i class="fas fa-comment"></i>
                                                <span>1276</span>
                                            </li>Future Home
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
@endsection