<div class="container">
    <div class="row immersive-1">
        <div class="immersive-img">
            <iframe width="" height=""src="https://www.youtube.com/embed/{{count($section->contents) >0 ?$section->contents[0]->video :null}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="immersive-content">
            <div class=" text-immersive">
                <a href="../page/item-immersive.html"><h4>{{__($section->title)}}</h4></a>
                <span class="text-font">{!!__($section->description)!!}
                   
                    </span>
            </div>
            
        </div>
    </div>
    
</div>