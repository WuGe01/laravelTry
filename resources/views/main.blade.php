@extends('home')
@section('center')
<div class="w-100 h-100">
    <div class="mvim">
        @isset($mvim)
            @foreach($mvim as $mv)
            <div class="mv w-100 text-center" style="display:none;"><img src="{{ asset('storage/'.$mv->img ) }}" alt=""></div>
            @endforeach
        @endisset
    </div>
    <div class="news">
        <div class="text-center py-2 border-bottom my-1">最新消息區
            @isset($more)
                <a class="position-absolute end-0" href="{{$more}}">more...</a>
            @endisset
        </div>
        @isset($news)
        <ul class="list-group position-relative">
            @foreach($news as $k => $new)
            <li class="list-group-item list-group-item-action p-1 newList" style="position:unset;">{{ $k+1 }} . {{ mb_substr($new->text,0,20,'utf8') }} ...
                <div>{{$new->text}}</div>
            </li>
            @endforeach
        </ul>
        @endisset
    </div>
</div>
@endsection