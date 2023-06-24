<div id="page_4">
    <div class="text-block">
        <div class="text-container">
            <span class="vr360-title">{{__($section->title)}}</span>
            <span style="display: inline-block;font-size: 24px;" class="video_content">{{__($section->sub_title)}}</span>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <amp-youtube class="video_gl" autoplay loop width="1200" height="500" layout="responsive"
                    data-videoid="{{count($section->contents) > 0 ?$section->contents[0]->video : null}}"></amp-youtube>
            </div>
        </div>
    </div>
</div>
