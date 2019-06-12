@extends('layouts.app')

@section('content')

<thread-view  :initial-repies-count="{{ $thread->replies_count }}" inline-template>
    <div class="flex flex-row flex-wrap">
        <div class="flex-1 pr-2">
            <div class=" p-5 bg-white mb-2 shadow rounded">
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
                <replies @removed="repliesCount--"></replies>
            </div>


        </div>

        <div class="w-1/4 p-5 bg-white mb-2 shadow rounded h-full">
            <div class="card">
                <p>
                    This thread was published {{ $thread->created_at->diffForHumans() }} by
                    <a href="{{ url('profile/'.$thread->owner->name)}}"><strong>{{ $thread->owner->name }}</strong>
                    </a>,
                    and currently
                    has <span v-text="repliesCount"></span> {{ str_plural('comment',  $thread->replies_count) }}.
                </p>

                <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
            </div>
        </div>

    </div>
</thread-view>

@endsection
