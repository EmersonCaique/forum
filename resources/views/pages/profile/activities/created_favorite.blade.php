@component('pages.profile.activities.activity')
@slot('heading')
<div >
        {{ $user->name }} favorited a reply
        {{-- <a href="thread/{{  $activity->subject->thread->channel->slug }}/{{  $activity->subject->thread->id}}" class="text-blue-500">
            {{  $activity->subject->thread->title }} </a>
        </div> --}}
    </div>
@endslot

@slot('body')
{{ $activity->subject->favorited->body }}

@endslot

@endcomponent
