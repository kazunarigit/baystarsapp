@extends('layouts.app')

@section('content')
    <ol class="container">
        @foreach($info as $data)
            <li>{{ $data }}</li>
        @endforeach
    </ol>
@endsection