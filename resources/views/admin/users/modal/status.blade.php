    <div class="modal fade" id="deactivate-user-{{ $user->id }}">
        <div class="modal-dialog " role="document">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger" id="modalTitleId">
                        <i class="fa-solid fa-user-slash"></i>Deactivate User
                    </h5>

                </div>
                <div class="modal-body">
                    Are you sure to deactivate <span class="fw-bold">{{ $user->name }}</span>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.deactivate',$user->id) }}" method="post">
                        @csrf
                        @method('DELETE')


                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Deactivate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
