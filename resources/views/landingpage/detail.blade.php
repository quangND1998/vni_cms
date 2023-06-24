@extends('landingpage.layout')
@section('content')
               <div class="page_item_news">
            <div class="container">
                <div class="row news_item">
                    <div class="news_item_left">
                        <h1>{{__($tintuc->TieuDe)}}</h1>
                        {!! __($tintuc->NoiDung)!!}
                        <div class="blog_post_news">
                            <div class="blog_share">
                                <span>{{__('share')}}</span>
                                <ul class="item_blog_icon">
                                    <li>
                                        <a href=""><i class="fab fa-facebook-f blog_icon"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fab fa-instagram-square blog_icon"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fab fa-youtube blog_icon"></i></a>

                                    </li>
                                    <li>
                                        <a href=""><i class="fab fa-twitter blog_icon"></i></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="blog_nav">
                                <div class="blog_previous ">
                                    <a href="" class="prev">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                        <span class="title_prev">{{__('previous_post')}}</span>
                                    </a>
                                </div>
                                <div class="blog_next">
                                    <a href="" class="next">
                                        <span class="title_prev">{{__('next_post')}}</span>
                                        <i class="fas fa-long-arrow-alt-right"></i>

                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="news_item_right">
                        <div class="list_item_right">
                            <h4>{{__('categories')}}</h4>
                            <ul style="padding-left:0">
                                <li class="link_news">
                                    <a href="">All</a>
                                    <span class="number_news">({{$number_all}})</span>
                                </li>
                                @foreach ($theloais as $theloai )
                                    <li class="link_news">
                                        <a href="">{{$theloai->Ten}}</a>
                                        <span class="number_news">({{$theloai->tintucs_count}})</span>
                                    </li>
                                @endforeach


                            </ul>

                        </div>
                        <h2 class="title_related_news">{{__('related_news')}}</h2>
                        <ul class="related_news">
                            @foreach($tintuc_lienquan as $tintuc )
                             <li class="col_related_news">
                                <div class="row ">
                                    <div class="news_is">
                                        <a href="{{route('new.detail',__($tintuc->TieuDeKhongDau))}}" ><img data-src="{{$tintuc->Hinh}}" width="100%" class="img_news lazyload"></a>
                                    </div>
                                    <div class="text_news">
                                        <h5><a href="{{route('new.detail',__($tintuc->TieuDeKhongDau))}}" >{{__($tintuc->TieuDe)}}</a></h5>
                                        <div class="der_news">
                                           {!!Str::words(strip_tags(__($tintuc->NoiDung)), 5, '...')!!} </div>
                                        <div class="box_duoi">
                                            <div class="left_news">


                                                <img data-src="../images/lich.svg" class="lazyload">{{ \Carbon\Carbon::parse($tintuc->created_at)->format('d/m/Y')}}</div>
                                            <a href="{{route('new.detail',__($tintuc->TieuDeKhongDau))}}"  class="read_view_2">{{__('see_more')}} <img src="../images/right.svg"></a>
                                        </div>
                                    </div>
                                </div>
                            </li>


                            @endforeach


                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <style>
            .news_item_left img{
                width: 100% !important;
            }
            .news_item_left a{
                color: #2196f3;
            }
        </style>
@endsection

