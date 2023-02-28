<div class="modal fade" id="deactivate-user-{{ $user->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h5 class="modal-title text-success" id="modalTitleId">
                    <i class="fa-solid fa-user-slash"></i>Activate User
                </h5>

            </div>
            <div class="modal-body">
                Are you sure you want to reactivate <span class="fw-bold">{{ $user->name }} ?</span>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.activate',$user->id) }}" method="post">
                    @csrf
                    {{-- @method('DELETE') --}}


                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>