{{-- clickable image --}}
<div class="p-0">
    <a href="{{ route('post.show', $post) }}">
        <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
    </a>
</div>
<div class="card-body">
    {{-- heart button --}}
    <div class="row align-items-center">
        <div class="col-auto">
            @if ($post->isLiked())
                <form action="{{ route('like.destroy',$post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid text-danger fa-heart"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('like.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="col-auto px-0">
            <span>{{ $post->likes->count() }}</span>
        </div>
        <div class="col text-end">
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>

    {{-- owner + description --}}
    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
    &nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <p class="small text-muted">{{ $post->created_at->diffForHumans() }}</p>

    <!-- COMMENTS SECTION -->
    @include('users.posts.comments.comments')
</div>
