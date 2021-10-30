@extends('home')
@section('center')
<h5 class="text-center py-2 border-bottom my-1">管理者認證</h5>
@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif
<form action="/login" method="post" class="mt-4">
    @csrf
    <p class="text-center">帳號：<input type="text" name="acc" id=""></p>
    <p class="text-center">密碼：<input type="text" name="pw" id=""></p>
    <p class="text-center">
        <input type="submit" class="btn btn-success" value="登入">
        <input type="reset" class="btn btn-warning" value="重置">
    </p>

</form>

@endsection