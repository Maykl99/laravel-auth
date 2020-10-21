{{-- parte home guest --}}
@extends('layouts.app')
@section('content')
    <div class="display-4 p-5 text-center">
        Benvenuto nel mio blog
    </div>
    @guest {{-- se sei un ospite --}}
    <p class="lead text-center">Guest</p>
    @else {{-- se sei autentificato --}}
        <p class="lead text-center">Il tuo nome è: {{ Auth::user()->name }} </p>
    @endguest
@endsection