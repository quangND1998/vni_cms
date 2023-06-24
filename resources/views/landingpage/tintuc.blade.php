@extends('landingpage.layout')
@section('content')
<div id="page_1" style="padding:150px 0;">
    <div class="container">
        <div class="row">
            <div class="list_news list_newsTop ">

                <div class="list_news ">
                    @foreach ($top2_news as $new )
                    <div class="item_news wow fadeInDown" data-wow-time=".1s" data-wow-delay=".1s">
                        <a href="new/{{__($new->TieuDeKhongDau)}}" >
                            <img src="{{$new->Hinh}}" alt="">
                            <div class="main_news">
                                <span class="title_Blog">{{$new->theloai->Ten}}</span>
                                <a href="{{route('new.detail',__($new->TieuDeKhongDau))}}" >
                                    <h4 class="title_news">{{__($new->TieuDe)}}</h4>
                                </a>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="row">
            <div class="list_news list_news2    ">
                @foreach ($top3_news as $new )
                <div class="item_news1 wow fadeInDown" data-wow-time=".3s" data-wow-delay=".3s">
                    <a href="{{route('new.detail',__($new->TieuDeKhongDau))}}" >
                        <img class="img_news" src="{{$new->Hinh}}" alt="">
                         <div class="news_col">
                            <span class="">{{$new->theloai->Ten}}</span>
                            <h4 class="title_news">{{__($new->TieuDe)}}</h4>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
        </div>

        <div class="product_visual">
            <div class="container">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'page_all')">All</button>
                    @foreach ($theloais as $theloai )
                        <button class="tablinks" onclick="openCity(event, '{{$theloai->TenKhongDau}}')">{{$theloai->Ten}}</button>
                    @endforeach


                </div>
                <hr class="line-width">
                <div id="page_all" class="tab_content active wow slideInLeft">
                    <div class=" page_item">
                        @foreach ($all_news as $tintuc )
                            <div class="item-slide">
                                <div class="product">

                                    <div class="main_news1">
                                            <img class="img_news" src="{{$tintuc->Hinh}}" alt="">
                                         <div class="Blog">
                                                    <span class="">{{$new->theloai->Ten}}</span>
                                                </div>
                                    </div>
                                    <a class="content_news" href="{{route('new.detail',__($tintuc->TieuDeKhongDau))}}" >
                                        <h4 class="">{{__($tintuc->TieuDe)}}
                                        </h4>
                                    </a>
                                    <span class="clock"><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($tintuc->created_at)->format('d/m/Y')}}</span>
                                </div>
                            </div>
                        @endforeach


                    </div>

                </div>
                @foreach ($theloais as  $theloai)


                <div id="{{$theloai->TenKhongDau}}" class="tab_content">
                    <div class=" page_item">
                        @foreach ($theloai->tintucs as $tintuc)
                            <div class="item-slide">
                            <div class="product">

                                <div class="main_news1">
                                     <img class="img_news" src="{{$tintuc->Hinh}}" alt="">
                                   <div class="Blog">
                                                    <span class="">{{$tintuc->theloai->Ten}}</span>
                                                </div>
                                </div>
                                <a class="content_news" href="{{route('new.detail',__($tintuc->TieuDeKhongDau))}}"  >
                                    <h4 class="">{{__($tintuc->TieuDe)}}
                                    </h4>
                                </a>
                                <span class="clock"><i class="fas fa-clock"></i>  {{ \Carbon\Carbon::parse($tintuc->created_at)->format('d/m/Y')}}</span>
                            </div>
                        </div>
                        @endforeach



                    </div>
                </div>
                 @endforeach

            </div>
        </div>
    </div>
</div>
<style>

.list_news{
    width: 100%;
}
.list_newsTop{
    height:350px;

}
.item_news img{
    height:100%;
    object-fit: cover;
    width: 100%;
}
.list_news2{
    height:200px;
}
.item_news1 img{
    height:100%;
    object-fit: cover;
    width: 100%;
}
.product h4 {
    color: black;
    font-weight: 600;
    text-transform: lowercase !important;
    font-size: 16px;
}
.product h4::first-letter{
    text-transform: capitalize;
}
/* blog */
.main_news1{
    position: relative;
}
.Blog{
    z-index: 10;
    position: absolute;
    bottom: 0;
    width: 100%;
}
.Blog span{
    display: inline-block;
    font-size: 10px;
    color: #fff;
    margin-right: 5px;
    padding: 2px 6px;
    background: #f70d28;
    text-transform: uppercase;
    letter-spacing: 1px;
    -webkit-transition: .2s;
    -o-transition: .2s;
    transition: .2s;
    text-decoration: none;

}
.title_Blog {
    z-index: 10;
    position: absolute;
    bottom: 0;
    width: 100%;
    left: 40%;
    display: inline-block;
    padding: 2px 6px;
    text-transform: uppercase;
    font-size: 10px;
    background: red;
    width: auto;
    margin-right: 5px;
}
.news_col{
    position: absolute;
    width: 100%;
    /* height: 100%; */
    overflow: visible;
    bottom: 3%;
    text-align: center;
}
.news_col span {
       width: 100%;
        left: 40%;
       background: red;
       color: #ffff;
       padding: 2px 6px;
        width: auto;
    display: inline-block;
    font-size: 10px;
    text-transform: uppercase;
}
.title_news{
    font-weight: 600;
}
</style>

@endsection
