@extends('layouts.app')

@section('content')
    <ol class="container">
        @foreach($titles as $title)
            <li>{{ $title }}</li>
        @endforeach
    </ol>
@endsection