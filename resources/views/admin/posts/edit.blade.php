@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            {{-- gestione degli errori --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.update', $post->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Titolo</label>
                <input name="title" type="text" class="form-control" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control" rows="3">{{ $post->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">

        </div>
    </div>
</div>
@endsection