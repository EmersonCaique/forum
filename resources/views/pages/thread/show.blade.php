@extends('layouts.app')

@section('content')
<ul>

        <li>{{ $thread->title }}</li>
        <li>{{ $thread->body }}</li>
</ul>
@endsection
