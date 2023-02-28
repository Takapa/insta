@extends('layouts.app')

@section('title', 'Home')


@section('content')
  
    <div class="row gx-4">
        <div class="col-7">
            @forelse ($all_posts as $post)

                <div class="card mb-3">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2>Share your photos</h2>
                    <p class="text-muted"> When you share photos, They'll appear on your profile </p>
                    <a href="{{ route('post.create') }}" class="text-decoration-none">Share your first photo</a>
                </div>
            @endforelse
        </div>

        @if ($suggested_users)
        <div class="col-5 border">
            <div class="row mb-4">
                <div class="col-8">
                    Seggestions for you
                </div>
                <div class="col-4 text-end">
                    <a href="#">See All</a> 
                </div>
            </div>

            {{-- if not, unfollow button here --}}
            <div class="row align-items-center">
                @forelse ($suggested_users as $user)
                    <div class="col-2">
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="#" class="rounded-circle avatar-sm ms-1">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm ms-1"></i>
                        @endif
                    </div>
                    <div class="col-5">
                        <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
                    </div>
                    <div class="col-5 text-end">
                        <form action=" {{ route('followUser.store') }} " method="post">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="following_id">
                            <button type="submit" class="dropdown-item text-info">Follow</button>
                        </form>
                    </div>
                @empty
                    <div></div>
                @endforelse
                @endif
            </div>
        </div>
    </div>
@endsection


