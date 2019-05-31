@extends('layouts.app')

@section('content')
<ul>

        <li>{{ $thread->title }}</li>
        <li>{{ $thread->body }}</li>
</ul>

<ul>
    @foreach ($thread->replies as $reply)
        <li>{{ $reply->body }}</li>
    @endforeach
</ul>
@endsection
