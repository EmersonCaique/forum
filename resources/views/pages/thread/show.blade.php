@extends('layouts.app')

@section('content')

<div class="flex flex-row flex-wrap">
    <div class="flex-1">
        <div class=" p-5 bg-white mb-2 mr-2 shadow rounded">
            <div class="card">
                <div class="mb-3 flex">
                    <h4 class="flex-1">
                        <a href="/thread/{{$thread->slug}}/{{$thread->title}}" class="underline text-blue-400">
                            {{ $thread->title }}
                        </a>
                    </h4>

                    @can('update', $thread)
                    <form action="{{ url('thread/'.$thread->channel->slug.'/'.$thread->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-red-400 underline">Delete Thread</button>
                    </form>
                    @endcan
                </div>
                <div>
                    <span class="italic">{{ $thread->body }}</li>
                </div>
            </div>
        </div>

        <div class=" flex flex-wrap">
            @foreach ($replies as $reply)
            <div class="w-full p-5 bg-white mb-2 mr-2 rounded border">
                <div class="mb-2 border-b pb-2 flex justify-between items-center">
                    <span>{{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}</span>
                    <form action="{{ url('/reply/'.$reply->id.'/favorites')}}" method="post">
                        @csrf
                        <button type="submit"
                            class="p-1 border border-blue-400 rounded  text-blue-400 text-xs">Favorite</button>
                    </form>
                </div>
                <div class="mb-3">
                    {{ $reply->body }}
                </div>
                @can('update', $reply)
                    <form action="{{ route('reply.destroy', $reply ) }}" method="post">
                        @method('delete')
                        @csrf
                        <button class="px-4 py-2 bg-red-400 text-white rounded mt-4">Delete</button>
                    </form>
                @endcan
            </div>
            @endforeach

            {{ $replies->links() }}
            @auth
            <div class="w-full p-5 bg-white mb-2 mr-2 border rounded text-right">
                <form
                    action="{{ route('thread.replies.store', ['channel' => $thread->channel->slug, 'thread' => $thread->id ] ) }}"
                    method="post">
                    @csrf
                    <textarea type="text" name="body" placeholder="New reply..." rows="3"
                        class="w-full focus:border-none border rounded px-3 py-3" required></textarea>
                    <button type="submit"
                        class="px-12 py-2 bg-blue-500 rounded shadow text-white text-right mt-4">Reply</button>
                </form>
            </div>
            @endauth
        </div>
    </div>

    <div class="w-1/4 p-5 bg-white mb-2 mr-2 shadow rounded">
        <div class="card">
            <p>
                This thread was published {{ $thread->created_at->diffForHumans() }} by
                <a href="{{ url('profile/'.$thread->owner->name)}}"><strong>{{ $thread->owner->name }}</strong> </a>,
                and currently
                has {{ $thread->replies_count }} {{ str_plural('comment',  $thread->replies_count) }}.
            </p>
        </div>
    </div>

</div>
@endsection
