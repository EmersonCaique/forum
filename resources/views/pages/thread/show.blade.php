@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    @forelse ($thread->replies as $reply)
    <div class="w-full p-5 bg-white mb-2 mr-2 rounded border">
        <div class="mb-2 border-b pb-2">
            <span>{{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}</span>
        </div>
        <div class="mb-3">
            {{ $reply->body }}
        </div>
    </div>

    @empty
    <div class="text-center w-full">
        <p>There are no relevant results at this time.</p>
    </div>
    @endforelse

    @auth
        <div class="w-full p-5 bg-white mb-2 mr-2 border rounded text-right">
            <form action="{{ route('thread.replies.store', ['thread' => $thread->id ]) }}" method="post">
                @csrf
                <textarea type="text" name="body" placeholder="New reply..." rows="3"
                    class="w-full focus:border-none" required></textarea>
                <button type="submit"
                    class="px-12 py-2 bg-blue-500 rounded shadow text-white text-right mt-4">Reply</button>
            </form>
        </div>
    @endauth
</div>
@endsection
