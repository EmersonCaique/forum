@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    @forelse ($threads as $thread)
    <div class="w-1/4 p-5 bg-white mb-2 mr-2 shadow rounded">
        <div class="card">
            <div class="mb-3">
                <h4>
                    <a href="thread/{{$thread->channel->slug }}/{{ $thread->id}}">
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

    @empty
    <div class="w-full  mt-10 text-center">
        <p class="block mb-8">There are no relevant results at this time.</p>
        <a href="{{ url('thread/create') }}" class="px-6 py-3 bg-green-300 mt-8 shadow rounded text-white">New
            Thread</a>
    </div>
    @endforelse
</div>
@endsection
