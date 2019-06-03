@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    <div class="w-full p-10 bg-white mb-2 mr-2 border rounded text-right">
        <form action="{{ route('thread') }}" method="post">
            @csrf

            <div class="text-left mb-4">
                <label for="" class="block">Channel</label>
                <select name="channel_id" class="w-full border rounded  px-2 py-2" required>
                    <option value="">Chose one...</option>
                    @forelse (App\Channel::all() as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : ''  }}>{{ $channel->description }}</option>
                    @empty

                    @endforelse
                </select>
            </div>

            <div class="text-left mb-4">
                <label for="" class="">Title</label>
                <input type="text" class="border rounded px-2 py-2 mt-2 w-full" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="text-left">
                <label for="" class="">Body</label>
                <textarea type="text" name="body" placeholder="New thread..." rows="3"
                    class="w-full focus:border-none border rounded px-2 py-2 mt-2" required>{{ old('body') }}</textarea>
            </div>

            @if (count($errors))
            @foreach ($errors->all() as $error)
                <div class="w-full text-left p-4 bg-red-500 text-white rounded mb-2">
                    {{ $error }}
                </div>
                @endforeach
            @endif
            <div class="w-full text-right">
                <button type="submit" class="px-12 py-2 bg-blue-500 rounded shadow text-white mt-4">Reply</button>
            </div>

        </form>
    </div>
</div>
@endsection
