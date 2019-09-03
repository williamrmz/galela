{{-- MY MODAL --}}
@php
    $idModal = isset($id)? $id: "myModal";

@endphp

<div class="modal fade" id="{{$idModal}}" style="display: none;">
    <div class="modal-dialog" id="{{$idModal}}Size">
        <div class="modal-content" style="background-color: #ecf0f5;">
            <div class="modal-header" style="border-bottom-color: #bdbdbd">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="{{$idModal}}Title">Title</h4>
            </div>
            <div class="modal-body" id="{{$idModal}}Body">
                body…
            </div>
        </div>
    </div>
</div>