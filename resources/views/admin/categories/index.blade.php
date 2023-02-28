@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-success text-secondary">
            <tr>
                <th></th>
                <th>NAME</th>
                <th>CREATED AT</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                        {{-- @if($post->trashed())
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
                        @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
