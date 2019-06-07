@component('pages.profile.activities.activity')
@slot('heading')
<div >
        {{ $user->name }} replied to
        <a href="thread/{{  $activity->subject->thread->channel->slug }}/{{  $activity->subject->thread->id}}" class="text-blue-500">
            {{  $activity->subject->thread->title }} </a>
        </div>
@endslot

@slot('body')
{{ $activity->subject->body }}

@endslot

@endcomponent
