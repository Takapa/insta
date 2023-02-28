@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <table class=" table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        @if ($post->image)
                            <img src="{{ asset('/storage/images/' . $post->image) }}" alt=""
                                class="d-block mx-auto avatar-md">
                        @else
                            <i class="fa-solid text-dark d-block text-center icon-md"></i>
                        @endif
                    </td>
                    <td>
                        @foreach ($post->categoryPost as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">
                                {{ $category_post->category->name }}
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold">{{ $post->user->name }}</a>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i> &nbsp; Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i> &nbsp; Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                        @if($post->trashed())
                            <div class="dropdown-menu">
                                <button class="dropdown-item text-primary" data-bs-toggle="modal"
                                    data-bs-target="#deactivate-user-{{ $post->id }}">
                                    <i class="fa-solid fa-eye"></i>Show {{ $post->id }}
                                </button>
                            </div>
                        </div>
                        @include('admin.posts.modal.status2')

                        @else
                            <div class="dropdown-menu">
                                <button class="dropdown-item text-secondary" data-bs-toggle="modal"
                                    data-bs-target="#deactivate-user-{{ $post->id }}">
                                    <i class="fa-solid fa-eye-slash"></i>Hide {{ $post->id }}
                                </button>
                            </div>
                        </div>
                        @include('admin.posts.modal.status')
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
