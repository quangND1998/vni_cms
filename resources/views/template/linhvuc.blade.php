 <div id="page_2">
     <div class="container">
         <div class="row mx-auto">
             <div class="col-md-12 ">
                 <h1 class=" mx-auto title">{{__($section->title)}}</h1>
                 <hr class="line">
             </div>

                <div class="slider_app ">
                    @foreach ($section->contents as $content)
                    @if($content->link)
                    <div class="item-slide">
                        <div class="application">
                            <a href="{{$content->link}}"  >
                                <img src="{{count($content->images) > 0 ? $content->images[0]->image  : ''}}" class="img-fluid w-25" alt="" >
                                <h4 class="title-app">{{__($content->title)}}</h4>

                            </a>
                            <span class="text-muted">{!!Str::words(__($content->description), 5, '...')!!}</span>
                        </div>
                    </div>
                    @else
                    <div class="item-slide">
                        <div class="application">
                            <a href="{{route('product.preview',__($content->sub_title))}}"  >
                                <img src="{{count($content->images) > 0 ? $content->images[0]->image  : ''}}" class="img-fluid w-25" alt="" >
                                <h4 class="title-app">{{__($content->title)}}</h4>

                            </a>
                            <span class="text-muted">{!!Str::words(strip_tags(__($content->description)), 5, '...')!!}</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>


         </div>
     </div>
 </div>
