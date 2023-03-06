<div class="modal fade" id="deactivate-user-{{ $category->id }}">
    <div class="modal-dialog " role="document">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h5 class="modal-title text-warning" id="modalTitleId">
                    <i class="fa-solid fa-pen-to-square"></i>Edit Category
                </h5>
            </div>
            <form action="{{ route('admin.categories.update',$category) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
