<div class="modal fade" id="deactivate-user-{{ $post->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-secondary" id="modalTitleId">
                    <i class="fa-solid fa-eye-slash"></i>Hide Post
                </h5>

            </div>
            <div class="modal-body">
                Are you sure to hide post <span class="fw-bold">{{ $post->id }} ?</span>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.hid',$post->id) }}" method="post">
                    @csrf
                    @method('DELETE')


                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary btn-sm">Hid</button>
                </form>
            </div>
        </div>
    </div>
</div>
