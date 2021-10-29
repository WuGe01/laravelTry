@extends('layouts.layout')

@section('main')

<div class="menu col-3 pl-0">
    <div class="text-center py-2 border-bottom my-1">主選單區</div>    
        @isset($menus)
        <ul class="list-group">
            @foreach($menus as $menu)
            <li class="list-group-item list-group-item-action position-relative menu">
                <a href="{{ $menu->href }}">{{ $menu->text }}</a>
                @isset($menu->subs)
                <ul class="list-group subs  position-absolute w-75" style="display:none;">
                    @foreach($menu->subs as $sub)
                    <li class="list-group-item list-group-item-action" style="z-index: 2;left: 100px;">
                        <a href="{{ $sub->href }}">{{ $sub->text }}</a>
                    </li>
                    @endforeach
                </ul>
                @endisset
            </li>
            @endforeach
        </ul>
        @endisset
        <div class="visit text-center w-100">
            訪客人數：{{$total}}
        </div>
</div>
<div class="main col-6">
    @isset($ads)
        <marquee behavior="" direction="">{{$ads}}</marquee>
    @endisset
@yield('center')

</div>
<div class="right col-3 pr-0">
<button class="btn btn-secondary w-100">管理登入</button>
<div class="text-center py-2 border-bottom my-1">校園映像</div>
<div class="up"></div>
@isset($images)
    @foreach($images as $image)
        <div class="img text-center m-1" style="display:none;"><img src="{{asset('storage/'.$image->img)}}" ></div>
    @endforeach
@endisset
<div class="down"></div>
</div>

@endsection

@section('script')

<script>

$('.menu').hover(
    function(){
        $(this).children('.subs').show();
    },
    function(){
        $(this).children('.subs').hide();
    }
)
$('.newList').hover(
    function(){
        $(this).children('div').show();
    },
    function(){
        $(this).children('div').hide();
    }
)


let num=$(".img").length;
let p=0;
$(".img").each((idx,dom)=>{
    if(idx<3){
        $(dom).show();
    }
})

$(".up,.down").on("click",function(){
    $(".img").hide();
    switch ($(this).attr('class')) {
        case 'up':
            p=(p>0)?--p:p;
        break;
            
        case 'down':
            p=(p<num-3)?++p:p;
        break;
    }
    $(".img").each((idx,dom)=>{
        if(idx>=p && idx<=p+2){
            $(dom).show();
        }
    })

})

$(".mv").eq(0).show();
let mvNum = $('.mv').length;
let now = 0;
setInterval(()=>{
    ++now;
    $('.mv').hide();
    $(".mv").eq(now%mvNum).show();
},3000);

</script>

@endsection