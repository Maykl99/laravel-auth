@extends('layouts.app')
@section('content')

    @if (session('statusModifica'))
      <div class="alert alert-success"> {{-- {{ ( ? 'alert-success': 'alert-warning') }} {{ ( Session::has('message') ? 'alert-success': 'alert-warning') }}--}}
          {{ session('statusModifica') }}
      </div>
    @elseif(session('statusCancella'))
      <div class="alert alert-warning"> 
        {{ session('statusCancella') }}
      </div>
    @endif

    {{-- @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif --}}
    
    <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td><a href="{{ route('posts.edit', $post->id ) }}">Edit</a></td>
                <td>
                    <form action="{{ route('posts.destroy', $post->id ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Cancella</button>
                    </form>
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
@endsection