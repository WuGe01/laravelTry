@extends('layouts.layout')

@section('main')

<div class="menu col-3">
<div class="list-group text-center">
        <div class="border-bottom my-2 p-1">後臺管理</div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/title">標題圖管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/ad">動態文字廣告管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/image">校園映像圖片管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/mvim">動畫圖片管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/total">進站人數管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/bottom">頁尾版權管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/news">最新消息管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/admin">管理者管理</a></div>
        <div class="list-group-item list-group-item-action px-0"><a class="d-block" href="/admin/menu">選單管理</a></div>
        <div class="border my-2 text-center">訪客人數：</div>
    </div>
</div>
<div class="main col-9 p-0 d-flex flex-wrap align-items-start">

<div class="col-8 border py-2 text-center">後臺管理</div>
<button class="col-4 btn btn-light border py-2 text-center">管理登出</button>
<div class="border w-100 p-1" style="height:500px"></div>

</div>


@endsection

@section('script')

@endsection