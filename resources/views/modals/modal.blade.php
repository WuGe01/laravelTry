<!-- Modal -->
<div class="modal fade" id="baseModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <form action="{{$action}}" method="post" enctype="multipart/form-data" class="w-100">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenter">{{ $modalHeader }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @isset($modalBody)
        <table class="m-auto">
        @csrf
        @isset($method)
            @method($method)
        @endisset
        @foreach($modalBody as $row)
          <tr>
            @isset($row['label'])
            <td class="text-right">{{$row['label']}}</td>
            @endisset
            <td>
              @switch($row['tag'])
                @case('input')
                  @include('layouts.input',$row)
                @break
                @case('textarea')
                  @include('layouts.textarea',$row)
                @break
                @case('img')
                  @include('layouts.img',$row)
                @break
              @endswitch
            </td>
          </tr>
        @endforeach
        </table>
        @endisset
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">儲存</button>
      </div>
    </div>
    </form>
  </div>
</div>