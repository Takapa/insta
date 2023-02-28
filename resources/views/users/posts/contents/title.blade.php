<div class="card-header bg-white py-3 ">
    <div class="row align-items-center">
        <div class="col-auto">
            {{-- avatar/icon --}}
            @if ($post->user->avatar)
                <img src="{{ asset('/storage/avatars/' . Auth::user()->avatar) }}" alt="#" class="rounded-circle avatar-sm ms-1">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm ms-1"></i>
            @endif
        </div>
        <div class="col ps-0">
            {{-- name of the owner --}}
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
        </div>
        <div class="col-auto">
            {{-- edit or delete if youre the owner of the post --}}
            <div class="dropdown">
                <button class="btn btn-sm " data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                @if ($post->user->id === Auth::id())
                    <div class="dropdown-menu">
                        <a href="{{ route('post.edit', $post) }}" class="dropdown-item text-warning">
                            <i class="fa-regular fa-pen-to-square"></i>Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-{{ $post->id }}">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    </div>

                    {{-- if not, unfollow button here --}}
                    @else
                    <div class="dropdown-menu">
                        @if ($post->user->isFollowed())
                            <form action=" {{ route('followUser.destroy',$post->user->id) }} " method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                            </form>
                        @else
                            <form action=" {{ route('followUser.store') }} " method="post">
                                @csrf
                                <input type="hidden" value="{{ $post->user->id }}" name="following_id">
                                <button type="submit" class="dropdown-item text-info">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('users.posts.contents.modals.delete')

