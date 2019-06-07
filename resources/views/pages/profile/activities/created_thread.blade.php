@component('pages.profile.activities.activity')
@slot('heading')
<div>
{{ $user->name }} published
<a href="thread/{{ $activity->subject->channel->slug }}/{{ $activity->subject->id}}" class="text-blue-500">
    {{ $activity->subject->title }} </a>
</div>
@endslot

@slot('body')
{{ $activity->subject->body}}

@endslot

@endcomponent
