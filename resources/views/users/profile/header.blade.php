<div class="row">
    <div class="col-4">
        @if($user->avatar)
            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail rounded-circle">
        @else
            <i class="fas fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>

    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>

            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{route('profile.edit', Auth::user()->id )}}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    <form action="" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" name="btn-main" value='page1を表示' class="text-decoration-none text-dark" onclick="SelectPage(1)">
                    <strong>{{ $user->posts->count() }}</strong> posts
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark" name="btn-main" value='page2を表示' onclick="SelectPage(2)">
                    <strong>{{ $user->followers->count() }}</strong> followers
                </a>  
            </div>
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark" name="btn-main" value='page3を表示' onclick="SelectPage(3)">
                    <strong>{{ $user->following->count() }}</strong> following
                </a>  
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>

    <script src="{{asset('/js/index.js')}}"></script>


</div>