<div class="row">
    <div class="event-itinerary w-100 ">
        <h1 class="title text-black">{{__($section->title)}}</h1>
        <div class="gallery">
            @foreach ($section->contents[0]->images as $image)
            <div class="gallery__item {{$image->element ==null ? '' :$image->element }}">
                <div class="embed {{$image->embed ==null ?'' :$image->embed }}" ">
                    <a href="{{$image->image}}" data-fancybox="gallery" data-caption="{{$image->name}}"><img
                        src="{{$image->image}}" /></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>