@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.update', $user) }}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h2 class="h3 mb-3 fw-light text-muted">Update Profile</h2>

            <div class="row mb-3">
                <div class="col-4">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="img-thumbnail rounded-circle d-block mx-3">
                    @else
                        <i class="fas fa-circle-user text-secondary d-block text-center icon-lg"></i>
                    @endif 
                </div>
                <div class="col-auto align-self-end">
                    <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-2" aria-describedby="avatar-info">
                    <div id="avatar-info" class="form-text">
                        Acceptable formats: jpeg.jpg.png.gif only <br>
                        Max file size is 1048kB
                    </div>
                    {{-- error --}}
                    @error('avatar')
                    <p class="text-danger small">{{ $message }}</p>
                    @enderror
                </div> 
            </div>

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                    {{-- error --}}
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                    {{-- error --}}
                </div>

                <div class="mb-3">
                    <label for="introduction" class="form-label fw-bold">introduction</label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself">{{ old('introduction', $user->introduction) }}</textarea>
                    {{-- error --}}
                </div>

                <button type="submit" class="btn btn-warning px-5">Save</button>

            </form>
        </div>
    </div>


@endsection