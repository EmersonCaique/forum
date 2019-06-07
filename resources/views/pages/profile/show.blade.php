@extends('layouts.app')

@section('content')

<div class="flex flex-col px-16">
    <span class="text-lg mb-16 text-center">

        {{ $user->name }} since {{ $user->created_at->diffForHumans() }}
    </span>

        @foreach ($activities as $date => $activity)
        <div class="my-2 text-center">
            {{ $date }}
        </div>
            @foreach ($activity as $record)
                @include("pages.profile.activities.{$record->type}", ['activity' => $record])
            @endforeach
        @endforeach
</div>


@endsection
