<div class="modal fade" id="deactivate-user-{{ $post->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h5 class="modal-title text-primary" id="modalTitleId">
                    <i class="fa-solid fa-eye"></i>Show Post
                </h5>

            </div>
            <div class="modal-body">
                Are you sure you want to show post <span class="fw-bold">{{ $post->id }} ?</span>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.show',$post->id) }}" method="post">
                    @csrf

                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Show</button>
                </form>
            </div>
        </div>
    </div>
</div>
