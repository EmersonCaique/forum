@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center ">
    <span class="text-lg">

        {{ $user->name }} since {{ $user->created_at->diffForHumans() }}
    </span>

    <span class="my-10 text-lg italic">
        Replies
    </span>

    <div class="px-10">

        @foreach ($user->threads as $thread)
        <div class="bg-white p-4 rounded border">
            <span>{{ $thread->title }}</span>
            <span>{{ $thread->body }}</span>
        </div>
        @endforeach
    </div>
</div>


@endsection
