@extends('layouts.app')

@section('content')
<ul>

    @foreach ($threads as $thread)
        <li>{{ $thread->title }}</li>
        <li>{{ $thread->body }}</li>
    @endforeach
</ul>
@endsection
