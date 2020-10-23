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

            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input name="title" type="text" class="form-control" placeholder="Inserisici il titolo">{{ old('title') }}
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control" rows="3">{{ old('body') }}</textarea>
                </div>
                <div class="form-group">
                    @foreach ($tags as $tag)
                        <label for="tag">{{ $tag->name }}</label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    @endforeach
                </div>

                
                <div class="form-group">
                    <label for="exampleFormControlFile1">Immagine</label>
                    <input accept="image/*" name="img" type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                
                  
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection