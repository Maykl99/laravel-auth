@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            
                @foreach ($posts as $post)
                
                <div class="col-sm-4 pt-3">

                <div class="card p-3" style="width: 18rem;">
                <img src="{{ Storage::url($post->img) }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::substr($post->body,0,130) }}</p>
                        <a href="{{ route('guest.posts.show', $post->slug ) }}" class="btn btn-primary">Dettagli</a>
                        <p class="card-text">{{ $post->user->name }}</p>
                     </div>
                </div>

                </div>

                @endforeach
            
        </div>
    </div>
@endsection