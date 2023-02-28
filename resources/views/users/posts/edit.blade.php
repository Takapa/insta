@extends('layouts.app')

@section('title', 'Edit post')

@section('content')

    <form action="{{ route('post.update',$post) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-muted fw-normal">(up to 3)</span>
            </label>
            @foreach ($all_categories as $category)
                @if (in_array($category->id, $selected_categories)) 
                {{--
                    in_array — 配列に値があるかチェックする
                    in_array(mixed $needle, array $haystack, bool $strict = false): bool
                    haystack 内の needle を検索します。 strict が設定されていない限りは型の比較は行わない。

                    つまり$selected_categories 内の $category->id を検索し、値があるかないかチェックする
                    --}}
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input" checked>
                        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}"
                            class="form-check-input">
                        <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control" placeholder="Whats on your mind?">{{ $post->description }}</textarea>
        </div>
        <div class="mb-4">
            <img src="{{ asset('/storage/images/'.$post->image) }}" class="img-thumbnail" alt="" height="250" width="250">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <div class="form-text">
                The acceptable formats are jpeg, jpg, png , and gif only <br>
                Max file size is 1048kb.
            </div>
        </div>
        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>

@endsection
