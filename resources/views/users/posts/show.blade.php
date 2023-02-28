@extends('layouts.app')

@section('title', 'Show post')

@section('content')
<style>
    .col-4{
        overflow-y:scroll;
    }

    .card-body{
        position: absolute;
        top: 65px;
    }
</style>
    <div class="row border shadow">
        <div class="col p-0 border-end">
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- avatar/icon --}}
                            @if ($post->user->avatar)
                                <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
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
                                        
                                        {{-- if not, unfollow button here --}}
                                    @else
                                        <div class="dropdown-menu">
                                            <form action="#" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                                            </form>
                                        </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-body w-100">
                <div class="row align-items-center mt-2">
                    <div class="col-auto mt-3 pe-1">

                        {{-- <span>
                        <!-- もし$likeがあれば＝ユーザーが「いいね」をしていたら -->
                        @if($like)
                        <!-- 「いいね」取消用ボタンを表示 -->
                        <form action="{{ route('like.destroy', $like->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-outline-none">
                               <i class="fa-solid text-danger fa-heart"></i>
                            </button>
                                <span class="">
                                    {{ $post->likes->count() }}
                                </span>
                        </form>
                                <!-- 「いいね」の数を表示 -->
                        @else
                        <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
                        <form action="{{ route('like.store', $post) }}" method="post">
                        @csrf
                            <button type="submit" method="post" class="btn btn-outline-none">
                                <i class="fa-regular  fa-heart"></i>
                            </button>
                            <!-- 「いいね」の数を表示 -->
                                <span class="">
                                    {{ $post->likes->count() }}
                                </span>
                            
                        </form>
                        @endif
                        </span> --}}

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
                                {{$category_post->category->name}}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- owner + description --}}
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>
                &nbsp;
                <p class="d-inline fw-light">{{ $post->description }}</p>
                <p class="small text-muted">{{ $post->created_at->diffForHumans() }}</p>

                {{-- comments section --}}
                <div class="mt-4">
                <form action="{{ route('comment.store', $post->id )}}" method="post">
                    @csrf
            
                    <div class="input-group">
                        <textarea name="comment_body{{ $post->id }}" row="1" placeholder="Add a comment..." class="form-control form-control-sm">{{ old('comment_body' . $post->id ) }}</textarea>
                        <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
                    </div>
                    {{-- erroe --}}
                    @error('comment_body' . $post->id)
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </form>
                {{-- show all comments here --}}
                @if($post->comments->isNotEmpty())
                <hr>
    
            <ul class="list-group mt-3">
                @foreach($post->comments as $comment)
                <li class="list-group-item border-0 p-0 mb-2">
                    <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark fw-bold">
                        {{ $comment->user->name }}
                    </a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $comment->body }}</p>
    
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
    
                        <span class="text-uppercase text-muted xsmall">
                            {{ date('M d, Y', strtotime($comment->created_at)) }}
                        </span>
    
                        {{-- if the user is the owner of the comment, show delete button --}}
                        @if (Auth::user()->id === $comment->user->id)
                            &middot;
                            <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        @endif
                    </form>
                </li>
                @endforeach
            </ul>
        @endif

        </div>
    </div>
</div>
    </div>
    </div>
@endsection
@include('users.posts.contents.modals.delete')