<div class="about-us">
    <div class="container-fluid">
        <div class="main-about">
            <div class="background-aboutus"></div>
            <div class="row content-aboutus">
                <h1 class="title">{{__($section->title)}}</h1>
                <div class="icon-contact text-center pt-4">
                    <a href="" class="pr-4"><i class="fab fa-facebook"></i></a>
                    <a href="" class="pr-4"><i class="fab fa-youtube"></i></a>
                    <a href="" class="pr-4"><i class="fab fa-instagram-square"></i></a>
                </div>
                <div class=" title-email">
                    <span>{{__('company_email')}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
@foreach ($section->contents as $content)
    @if(count($content->images) > 0)
    .main-about .background-aboutus {
        background-image: url({{ $content->images[0]->image }});
    }
    @endif
@endforeach
</style>
