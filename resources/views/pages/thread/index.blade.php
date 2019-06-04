@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    @forelse ($threads as $thread)
    <div class="w-full p-5 bg-white mb-2 mr-2 justify-between shadow rounded">
        <div class="card">
            <div class="mb-3 border-b pb-5">
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
            <div class="text-right mt-2">
            <span  class="text-muted">{{ $thread->replies_count }} {{ str_plural('reply',  $thread->replies_count) }}</span >
            </div>
        </div>
    </div>

    @empty
    @auth
        <div class="w-full  mt-10 text-center">
            <p class="block mb-8">There are no relevant results at this time.</p>
            <a href="{{ url('thread/create') }}" class="px-6 py-3 bg-green-300 mt-8 shadow rounded text-white">New
                Thread</a>
        </div>

    @endauth
    @guest
        <div class="w-full  mt-10 text-center">
                <p class="block mb-8">Register for create threads...</p>
                <a  href="{{ route('register') }}"  class="px-6 py-3 bg-green-300 mt-8 shadow rounded text-white">New Account</a>

            </div>
    @endguest
    @endforelse
</div>
@endsection
