 <div id="page_6">
                <div class="container">
                    <div class="row">
                      
                        <div class="text_logo">
                            <h1 class="title">{{__($section->title)}}</h1>
                        </div>
                        <hr class="line">
                       
                        <div class="menu_logo">
                            @foreach ($section->contents as $content)
                            <div class="img_doitac">
                                @if(count($content->images) >0)
                                    <img src="{{$content->images[0]->image}}" class="lazyload">
                                @endif
                                
                            </div>
                            @endforeach
                        </div>
                     
                      
                    </div>
    </div>
</div>