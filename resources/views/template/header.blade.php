<div id="slider_img">
    <div class="slider-gallery">
        @foreach ($section->contents as $content )
        <div class="box_gallery" style="display: none;">
            @if(count($content->images) >0)
            <img src="{{$content->images[0]->image}}" class="anh_slide">
            @endif
            <div class="text_slide">
                <div class="center_text">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>{{__($content->title)}}</h1>
                                <a href="{{$content->link}}"  class="watch_video">{{__('see_more')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="slide_box">
        <div class="container">
            <div class="row">
                <div class="slider-icon">
                    @foreach ($section->contents as  $content)
                        <div class="kc_box_cat">
                            <div class="box_cat">
                                <h4>{{__($content->title)}}</h4>
                                <div class="ins_cat">
                                    <!-- <img src="uploads/gallery/tim-hieu-cong-nghe-1577939108.png" class="ico_cat"> -->
                                    <img src="{{$content->image}}" class="ico_cat">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
