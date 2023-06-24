<div id="page_1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 centerab">
                <div class="left_about">
                    <h1>{{__($section->title)}}</h1>
                    <h3>{{__($section->sub_title)}}</h3>
                    <div class="der_about">
                        {!!__($section->description)!!}
                        </div>
                    <a href="/contact" class="read_view">{{__('contact_us')}}</a>
                </div>
                @foreach($section->contents as $content)
                @foreach ($content->images as  $image)
                    <div  class="right_about">
                        <img src="{{$image->image}}">
                    </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>