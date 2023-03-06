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
                        <button class="text-warning border border-none" data-bs-toggle="modal"
                            data-bs-target="#deactivate-user-{{ $category->id }}">
                            <i class="fa-solid fa-pen-to-square"></i>Edit
                        </button>
                        @include('admin.categories.modal.status')
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row w-25 mx-1">
            <input type="text" name="name" class="col-9 border-light">
            <button type="submit" class="btn btn-success btn-sm col-3">+Add</button>      
        </div>
    </form>
    </div>
    
@endsection
