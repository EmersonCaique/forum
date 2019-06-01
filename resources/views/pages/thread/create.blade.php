@extends('layouts.app')

@section('content')
<div class="flex flex-wrap">
    <div class="w-full p-10 bg-white mb-2 mr-2 border rounded text-right">
        <form action="{{ route('thread.store') }}" method="post">
            @csrf
            <div class="text-left">
                <label for="" class="">Title</label>
                <input type="text" class="border rounded px-4 py-2 mt-2 w-full" name="title">
                <div class="text-left mt-4">
                    <label for="" class="">Body</label>
                    <textarea type="text" name="body" placeholder="New thread..." rows="3"
                        class="w-full focus:border-none border rounded px-4 py-3 mt-2" required></textarea>
                </div>
                <div class="w-full text-right">
                    <button type="submit"
                        class="px-12 py-2 bg-blue-500 rounded shadow text-white mt-4">Reply</button>
                </div>
        </form>
    </div>
</div>
@endsection
