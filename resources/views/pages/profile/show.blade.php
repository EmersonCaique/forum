@extends('layouts.app')

@section('content')
{{ $user->name }}



@foreach ($user->threads as $thread)
<span>{{ $thread->title }}</span>
<span>{{ $thread->body }}</span>
@endforeach
@endsection
