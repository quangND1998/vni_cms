<div class="about-us">
    <div class="container-fluid">
        <div class="main-about">
            <div class="background-aboutus" style="background-image :url({{(count($section->contents)>0 && count($section->contents[0]->images) >0) ? $section->contents[0]->images[0]->image :'' }})"></div>
            <div class="col-lg-12 single_page_contact">
                <h1 class="title">{{__('contact_us')}}</h1>
                <div class="icon-contact text-center pt-4">
                    <a href="{{__('nemoviz_facebook')}}" class="pr-4"><i class="fab fa-facebook"></i></a>
                    <a href="{{__('nemoviz_youtube')}}" class="pr-4"><i class="fab fa-youtube"></i></a>
                    <a href="{{__('nemoviz_instagram')}}" class="pr-4"><i class="fab fa-instagram-square"></i></a>
                </div>
                <div class=" title-email">
                    <span>{{__('company_email')}}</span>
                </div>
                <!-- <hr class="line" style="padding-bottom:1rem">
                <span class="content_contact"> Để đưa các dự án Bất động sản của bạn hòa mình vào thế giới ảo </span>
                    <button class="btn_hotline">Hotline : 0868 577 199</button>
                    <span class="title_form" >Hoặc liên hệ theo form:</span> -->

                    
            </div>
            <!-- <div class="row content-aboutus">
                <h1 class="">{{__('contact_us')}}</h1>
            </div> -->
        </div>
    </div>
</div>