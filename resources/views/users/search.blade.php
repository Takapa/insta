@extends('layouts.app')

@section('title', 'Section')

@section('content')

<div class="row align-items-center">
    <h3>Users</h3>
    @forelse ($users as $user)
        <div class="col-2 mb-3">
            @if ($user->avatar)
                <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="#" class="rounded-circle avatar-sm ms-1">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-sm ms-1"></i>
            @endif
        </div>
        <div class="col-5">
            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-primary">{{ $user->name }}</a>
        </div>
        <div class="col-5 text-end">
            <form action=" {{ route('followUser.store') }} " method="post">
                @csrf
                <input type="hidden" value="{{ $user->id }}" name="following_id">
                <button type="submit" class="dropdown-item text-info">Follow</button>
            </form>
        </div>
    @empty
        <div class="text-primary text-center h3">No Users</div>
    @endforelse

    <h3 class="mt-5">Posts</h3>
    @foreach ($users as $user)
        @forelse ($user->posts as $post)
        <div class="card bg-white mb-3" style="width:500px;">
            <div class="card-header row align-items-center">
                <div class="col-auto">
                    {{-- avatar/icon --}}
                    @if ($user->avatar)
                        <img src="{{ asset('/storage/avatars/' . Auth::user()->avatar) }}" alt="#" class="rounded-circle avatar-sm">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                    @endif
                </div>
                <div class="col ps-0">
                    {{-- name of the owner --}}
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
                </div>
            </div>

            <div class="p-0">
                <a href="{{ route('post.show', $post) }}">
                    <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
                </a>
            </div>

            <div class="card-body ps-0">
                <p class="d-inline fw-light">{{ $post->description }}</p>
                <p class="small text-muted">{{ $post->created_at->diffForHumans() }}</p>                    
            </div>
        </div>
        @empty
        <div class="text-secondary text-center h3">No Posts</div>
        @endforelse
    @endforeach
</div>

@endsection