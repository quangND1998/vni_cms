<div id="page_8">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-md-12 ">
                <h1 class=" mx-auto title">{{__($section->title)}}</h1>
                <hr class="line">
            </div>
            <div class=" title-content">
                <span class=" mx-auto">{{__($section->sub_title)}}</span>
            </div>
        </div>
        <div class="row">
            <div class="slider_product">
                @foreach ($contents as $content )
                <div class="item-slide">
                    <div class="product">
                        @if($content->link)
                        <a href="{{$content->link}}"  >
                            <div class="img_page_video">
                                @if($content->video)
                                    <img src="http://i3.ytimg.com/vi/{{$content->video}}/hqdefault.jpg" alt="">
                                @else
                                    @if(count($content->images) >0 )
                                        <img src="{{$content->images[0]->image}}" alt="">
                                    @endif
                                @endif
                                @if($content->video)
                                    <div class="icon_video">
                                        <i class="fas fa-play"></i>
                                    </div>
                                @endif
                            </div>

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
                            <h4 class="title_product"> {{__($content->title)}}</h4>
                        </a>
                        @elseif($content->link == null && $content->video != null)
                        <a href="https://www.youtube.com/embed/{{ $content->video }}"  data-fancybox>
                            <div class="img_page_video">
                                <img src="http://i3.ytimg.com/vi/{{$content->video}}/hqdefault.jpg" alt="">
                                <div class="icon_video">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>

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
                            <h4 class="title_product"> {{__($content->title)}}</h4>
                        </a>
                        @else
                        <a href="{{route('product.preview',__($content->sub_title))}}"  >
                            <div class="img_page_video">
                                @if($content->video)
                                    <img src="http://i3.ytimg.com/vi/{{$content->video}}/hqdefault.jpg" alt="">
                                @else
                                    @if(count($content->images) >0 )
                                        <img src="{{$content->images[0]->image}}" alt="">
                                    @endif
                                @endif
                                @if($content->video)
                                    <div class="icon_video">
                                        <i class="fas fa-play"></i>
                                    </div>
                                @endif
                            </div>

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
                            <h4 class="title_product"> {{__($content->title)}}</h4>
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
