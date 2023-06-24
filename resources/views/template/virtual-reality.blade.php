<div id="page_1">
        <div class="product_visual">
            <div class="container">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'page_all')">All</button>
                    @foreach ($section->category_contents as $category )
                    <button class="tablinks"
                        onclick="openCity(event, '{{$category->title}}')">{{__($category->title)}}</button>
                    @endforeach
                </div>
                <hr class="line-width">
                <div id="page_all" class="tab_content active">
                    <div class="page_item">

                        @foreach ($section->cate_contents as $content )


                        <div class="item-slide">
                            <div class="product">
                            <a href="{{route('product.preview',__($content->sub_title))}}">
                                    @if(count($content->images) >0)
                                    <img src="{{$content->images[0]->image}}" alt="">
                                    @endif

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
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
                @foreach ($section->category_contents as $category )

                <div id="{{$category->title}}" class="tab_content">
                    <div class=" page_item">
                        @foreach ($category->contents as $content )
                        <div class="item-slide">
                            <div class="product">
                           <a href="{{route('product.preview',__($content->sub_title))}}">
                                    @if(count($content->images) >0)
                                    <img src="{{$content->images[0]->image}}" alt="">
                                    @endif
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
                                    <h4 class="title_product">{{__($content->title)}}</h4>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

</div>
{{-- <style>
     .fancybox-container {
        position: fixed;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            z-index: 9999999;
                                            -webkit-backface-visibility: hidden;
                                            backface-visibility: hidden;
                                         }

                                        .fancybox-container~.fancybox-container {
                                            z-index: 99992
                                        }
</style> --}}
