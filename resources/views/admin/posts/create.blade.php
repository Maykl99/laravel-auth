@extends('layouts.app')
@section('content')
<form action="{{ route('posts.store') }}" method="post">
    @csrf
    @method('POST')
    <div class="form-group">
      <label for="title">Titolo</label>
      <input name="title" type="text" class="form-control" placeholder="Inserisici il titolo">
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control" rows="3"></textarea>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection