@extends('layouts.app')

@section('content')
<div class="w-full p-5 bg-white mb-2 mr-2 shadow rounded">
    <div class="card">
        <div class="mb-3">
            <h4>
            <a href="/thread/{{$thread->slug}}/{{$thread->title}}">
                    <strong>
                        {{ $thread->title }}
                    </strong>
                </a>
            </h4>
        </div>
        <div>
            <span class="italic">{{ $thread->body }}</li>
        </div>
    </div>
</div>

<div class="flex flex-wrap">


    @foreach ($thread->replies as $reply)
    <div class="w-full p-5 bg-white mb-2 mr-2 rounded border">
        <div class="mb-2 border-b pb-2">
            <span>{{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}</span>
        </div>
        <div class="mb-3">
            {{ $reply->body }}
        </div>
    </div>

    @endforeach
    @auth
        <div class="w-full p-5 bg-white mb-2 mr-2 border rounded text-right">
        <form action="{{ route('thread.replies.store', ['channel' => $thread->channel->slug, 'thread' => $thread->id ] ) }}" method="post">
                @csrf
                <textarea type="text" name="body" placeholder="New reply..." rows="3"
                    class="w-full focus:border-none border rounded px-3 py-3" required></textarea>
                <button type="submit"
                    class="px-12 py-2 bg-blue-500 rounded shadow text-white text-right mt-4">Reply</button>
            </form>
        </div>
    @endauth
</div>
@endsection
