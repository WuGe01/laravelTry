@extends('home')
@section('center')
<h5 class="text-center py-2 border-bottom my-1">最新消息區</h5>
    @isset($news)
        <ul class="list-group position-relative">
            @foreach($news as $k => $new)
            <li class="list-group-item list-group-item-action p-1 newList" style="position:unset;">{{ $k+1 }} . {{ mb_substr($new->text,0,20,'utf8') }} ...
                <div>{{$new->text}}</div>
            </li>
            @endforeach
        </ul>
        {{ $news->links() }}
    @endisset
@endsection