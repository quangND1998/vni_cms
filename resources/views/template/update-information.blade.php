
            <div id="page_3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="title_small">{{__($section->title)}}</h4>
                            <h3 class="title_big">{{__($section->sub_title)}}</h3>
                        </div>
                        <div class="slider_news">
                            @foreach ($news as $new )
                            <div class="box_news"  style="height: 180px">
                                <div class="news_is">
                                    <a href="page/item_news.html" >
                                        <img data-src="{{$new->Hinh}}" class="img_news lazyload">

                                    </a>
                                </div>
                                <div class="text_news">
                                    <h5><a href="{{route('new.detail',__($new->TieuDeKhongDau))}}" >{{__($new->TieuDe)}}</a></h5>
                                    <div class="der_news">
                                        {!!Str::words(strip_tags(__($new->NoiDung)), 10, '...')!!}</div>
                                    <div class="box_duoi">
                                        <div class="left_news">
                                            <img data-src="images/lich.svg" class="lazyload"> {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y')}} </div>
                                        <a href="{{route('new.detail',__($new->TieuDeKhongDau))}}"  class="read_view_2">{{__('see_more')}} <img
                                                src="images/right.svg"></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach



                        </div>
                    </div>

                </div>
            </div>
