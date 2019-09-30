{{-- MY MODAL --}}
@php
    $id = isset($id)? $id: "myModal";
    $title = isset($title)? $title: "Modal";
    $size = isset($size)? $size: "";
    $animation = (isset($animation) && $animation==true)? 'fade': '';
    $content = isset($content)? $content: 'write a specific content';
@endphp

<div class="modal {{$animation}}" id="{{$id}}" style="modal hide" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog {{$size}}" id="{{$id}}Size">
        <div class="modal-content" style="background-color: #ecf0f5;">
            <div class="modal-header" style="border-bottom-color: #bdbdbd">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="{{$id}}Title">{{$title}}</h4>
            </div>
            <div class="modal-body" id="{{$id}}Body">
                {!! $content !!}


               
            </div>
        </div>
    </div>
</div>