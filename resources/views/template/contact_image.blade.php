<div class="company-overview">
    <div class="container">
        <div class="company-gallery">
            <div class="text-company-overview">
                <h1 class="title  text-black" data-aos="fade-right"> {{__($section->title)}}</h1>
                <span class="text1 text-font" >{!!__($section->description)!!}</span>

            </div>
            <div class="img-company-overview" data-aos="fade-left">
                <div class="slider-for">

                    @foreach ($section->contents as $content)
                        @if(count($content->images) >0)
                            <img src="{{ $content->images[0]->image }}" alt="">
                        @endif
                    @endforeach
                </div>
                <div class="slider-nav">
                    @foreach ($section->contents as $content)
                        @if(count($content->images) >0)
                            <img src="{{ $content->images[0]->image }}" alt="">
                        @endif
                    @endforeach

                </div>
            </div>
        </div>

    </div>

</div>
