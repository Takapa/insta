@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    @include('users.profile.header')

    {{-- show all posts here --}}
    <div style="margin-top:100px;">
        @if ($user->posts->isNotEmpty())
        <div class="row page1" id="page1">
            @foreach ($user->posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="grid-img">
                    </a>
                </div>
            @endforeach
        </div>
        @else
            <h3 class="text-muted text-center">No Posts Yet</h3>
        @endif
    </div>

    {{-- show all followers here --}}
    <div style="margin-top:100px;" class="page2" id="page2">
        <div class="row w-50 mx-auto">
        @if ($user->followers->isNotEmpty())                    
            @foreach ($followed_users as $user)
                <div class="col-2">
                    @if ($user->avatar)
                        <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="#" class="rounded-circle avatar-sm ms-1">                        @else
                            <i class="fa-solid fa-circle-user text-secondary icon-sm ms-1"></i>
                    @endif
                </div>
                <div class="col-5">
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
                </div>
                <div class="col-5">
                    <form action=" {{ route('followUser.store') }} " method="post">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="following_id">
                        <button type="submit" class="dropdown-item text-info">Follow</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="text-center h3">No followers</div>
        @endif
    </div>
    </div>

    {{-- show all following here --}}
    <div style="margin-top:100px;" class="page3" id="page3">
        <div class="row w-50 mx-auto">
        @if ($user->following->isNotEmpty())
            @foreach ($following_users as $user)
                <div class="col-2 mb-3">
                    @if ($user->avatar)
                        <img src="{{ asset('/storage/avatars/' . $user->avatar) }}" alt="#" class="rounded-circle avatar-sm ms-1">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-sm ms-1"></i>
                    @endif
                </div>
                <div class="col-5">
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">{{ $user->name }}</a>
                </div>
                <div class="col-5">
                    <form action=" {{ route('followUser.destroy',$user->id) }} " method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                    </form>
                </div>
            @endforeach
        @else
            <div class="text-center h3">No following</div>
        @endif
        </div>
    </div>


@endsection