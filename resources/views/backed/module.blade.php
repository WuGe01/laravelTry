@extends('layouts.layout')

@section('main')

@include('layouts.backedMenu')

<div class="main col-9 p-0 d-flex flex-wrap align-items-start">
<div class="col-8 border py-2 text-center">後臺管理</div>
<button class="col-4 btn btn-light border py-2 text-center">管理登出</button>
<div class="border w-100 p-1" style="height:500px;overflow: auto;">
<h5 class="text-center border-bottom py-3">
@if($modal != 'Total' && $modal != 'Bottom' )
<button class="btn btn-sm btn-primary" style="float: left;" id="addRow">新增</button>
@endif
{{ $header }}</h5>
<table class="table border-none text-center">
<tr>
@isset($cols)
    @if($modal != 'Total' && $modal != 'Bottom' )
        @foreach($cols as $col)
        <td width="">{{ $col }}</td>
        @endforeach
    @endif
@endisset    
</tr>
@isset($rows)
@if($modal != 'Total' && $modal != 'Bottom' )
@foreach($rows as $row)
<tr>
    @foreach($row as $r)
    <td>
        @switch($r['tag'])
            @case('img')
                @include('layouts.img',$r)
            @break
            @case('button')
                @include('layouts.button',$r)
            @break
            @case('textarea')
                @include('layouts.textarea',$r)
            @break
            @default
                {{ $r['text'] }}
        @endswitch
    </td>
    @endforeach
</tr>
@endforeach
@else
    <tr>
        <td> {{ $cols[0] }} </td>
        <td> {{ $rows[0]['text'] }} </td>
        <td> @include('layouts.button',$rows[1]) </td>
    </tr>
@endif
@endisset
</table>
</div>
</div>


@endsection


@section("script")
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});    
function switchModal(modal) {
    $("#modal").html(modal);
        $("#baseModal").modal("show");
        $("#baseModal").on('hidden.bs.modal', function () {
            $("#baseModal").modal('dispose');
            $("#modal").html('');
        })    
}
$("#addRow").on("click",function(){
    @isset($menu_id)

        $.get("/modals/add{{$modal}}/{{$menu_id}}",function(modal){
            switchModal(modal);
        })

    @else

        $.get("/modals/add{{$modal}}",function(modal){
            switchModal(modal);
        })
        
    @endif
});

$(".edit").on("click",function(){
    let id=$(this).data('id');
    $.get(`/modals/{{ strtolower($modal) }}/${id}`,function(modal){
        switchModal(modal);
    })
});
$(".delete").on("click",function(){
    let id=$(this).data('id');
    let _this=$(this);
    $.ajax({
        type:`delete`,
        url:`/modals/{{ strtolower($modal) }}/${id}`,
        success:function() {
            _this.parents('tr').remove();
        },
    });
});
$(".show").on("click",function(){
    let id=$(this).data('id');
    $.ajax({
        type:`patch`,
        url:`/modals/{{ strtolower($modal) }}/sh/${id}`,
        success:function() {
            location.reload();
        },
    });
});
$(".sub").on("click",function(){
    let id=$(this).data('id');
    location.href=`/admin/submenu/${id}`;
});
</script>
@endsection